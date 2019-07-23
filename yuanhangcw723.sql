/*
 Navicat MySQL Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50717
 Source Host           : localhost:3306
 Source Schema         : yuanhangcw

 Target Server Type    : MySQL
 Target Server Version : 50717
 File Encoding         : 65001

 Date: 23/07/2019 17:01:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yh_addresses
-- ----------------------------
DROP TABLE IF EXISTS `yh_addresses`;
CREATE TABLE `yh_addresses`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `consignee` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '收件人',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '联系人电话',
  `province` mediumint(8) UNSIGNED NOT NULL COMMENT '省级代码',
  `city` mediumint(8) UNSIGNED NOT NULL COMMENT '市级代码',
  `district` mediumint(8) UNSIGNED NOT NULL COMMENT '区级代码',
  `detailed_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '详细地址',
  `full_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '完整地址',
  `is_default` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '是否为默认地址：100=不是,101=是',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户地址表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_addresses
-- ----------------------------
INSERT INTO `yh_addresses` VALUES (1, 3, '李蒙', '15730241991', 500000, 500100, 500107, '石桥铺', '重庆市-重庆城区-九龙坡区', 101, '', '2019-05-31 21:05:47', '2019-05-31 21:05:47');
INSERT INTO `yh_addresses` VALUES (2, 3, '了', '15768241991', 110000, 110100, 110101, '哈哈', '北京市-北京城区-东城区', 100, '', '2019-06-03 16:53:40', '2019-06-03 16:53:40');
INSERT INTO `yh_addresses` VALUES (3, 2, '在一起的时候', '13594369472', 120000, 120100, 120102, '在一起的时候我们就', '天津市-天津城区-河东区', 100, '', '2019-06-12 10:05:58', '2019-06-12 10:05:58');

-- ----------------------------
-- Table structure for yh_admins
-- ----------------------------
DROP TABLE IF EXISTS `yh_admins`;
CREATE TABLE `yh_admins`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '昵称',
  `signature` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '个性签名',
  `email` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '登录地区',
  `ip` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '登录IP',
  `headimgurl` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '用户头像',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `api_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admins_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `admins_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_admins
-- ----------------------------
INSERT INTO `yh_admins` VALUES (1, 'admin', '秒老鼠', '我是超级管理员', '616877020@qq.com', '$2y$10$dIp9wyKf1X89deHJgLvzJ.c0XATIz1769hq/cY.bvQFsoQ0S/DwGC', 'clpfaBLYF93aC2rNnq6ytCJXaR6qABfPw9elhIzrTcnNl7Yy5fsnOKEqIepo', 'Localhost', '127.0.0.1', 'admin/YzwMq1kdnjOBfqW3kNgMLrl2EJfSHL74SrSTWKsl.jpeg', '2018-08-10 21:18:05', '2019-06-13 22:33:45', NULL);
INSERT INTO `yh_admins` VALUES (2, 'admin2', '秒老鼠2', '我是超级管理员2', '6168177020@qq.com', '$2y$10$VVk8p090pGNCpMDym7JiT.cCm2zEMZM09XTmXpfOg5weSRC0xPuPG', 'clpfaBLYF93aC2rNnq6ytCJXaR6qABfPw9elhIzrTcnNl7Yy5fsnOKEqIepo', 'Localhost', '127.0.0.1', 'admin/YzwMq1kdnjOBfqW3kNgMLrl2EJfSHL74SrSTWKsl.jpeg', '2018-08-10 21:18:05', '2019-07-19 21:58:19', NULL);

-- ----------------------------
-- Table structure for yh_ads
-- ----------------------------
DROP TABLE IF EXISTS `yh_ads`;
CREATE TABLE `yh_ads`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` smallint(5) NOT NULL COMMENT '广告分类',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告名称',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '广告图片',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '跳转链接',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序，数值越大越靠前',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '状态：100=关闭，101=开启',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_ads_class
-- ----------------------------
DROP TABLE IF EXISTS `yh_ads_class`;
CREATE TABLE `yh_ads_class`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序，数值越大越靠前',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '状态：100=关闭，101=开启',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_article_class
-- ----------------------------
DROP TABLE IF EXISTS `yh_article_class`;
CREATE TABLE `yh_article_class`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `is_show` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '是否展示：100=不展示，101=展示',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_article_class
-- ----------------------------
INSERT INTO `yh_article_class` VALUES (1, '1', 0, 101, NULL, NULL);

-- ----------------------------
-- Table structure for yh_articles
-- ----------------------------
DROP TABLE IF EXISTS `yh_articles`;
CREATE TABLE `yh_articles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章标题',
  `uploadImage` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '文章内容',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `is_show` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '是否展示：100=不展示，101=展示',
  `is_top` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '是否置顶：100=不置顶，101=置顶',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_articles
-- ----------------------------
INSERT INTO `yh_articles` VALUES (11, 2, 'a', 'app_background/nMOqf8vytKVyU00o3yieBzcmStnZIROlj2ZuRVbO.jpeg', '<p>aaa</p>', 0, 101, 101, '2019-07-23 16:26:33', '2019-07-23 16:26:33');
INSERT INTO `yh_articles` VALUES (12, 1, 'b', 'app_background/O6gGuljeSD4jSqmvKAhuINdJabKHBjK1fFGwxtae.jpeg', '<p>bbb<img class=\"wscnph\" src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8PDQ0NDRIPDw4NDQ0NDQ0NDw8NDQ0NFREWFhURFRUYHSggGBolGxUVITIhJSk3Li8wFx8zODMsNygtLisBCgoKDg0OFRAQFy0dFR0tKystLS0tLS0tLS0rKystKy0tLS0tLS0tLS0rLSsrKysrLSstKy0tKy0tLS0rKy0tLf/AABEIALEBHAMBEQACEQEDEQH/xAAcAAACAwEBAQEAAAAAAAAAAAACAwABBAUGBwj/xAA2EAACAgEDAwIEBQMDBAMAAAABAgADEQQSEwUhMUFRBiJhkQcUMnGBUqGxYnLhQlPB0RUWM//EABoBAAMBAQEBAAAAAAAAAAAAAAABAgMEBQb/xAAuEQEAAwACAQMDAwMDBQAAAAAAAQIRAxIEITFBE1FhBRQiMnGxQoHRFZHB4fD/2gAMAwEAAhEDEQA/APkG2em5dVtiw9Vthg1NsMGpthg1W2GHqbYYNTbDBqbYsGq2wwam2GDU2wwam2GDU2wwam2GDU2wPUxENViA1MQGpiA1WIDUxAamIDV4gFYiNMQwJAKxAKgExDDTEMJMQwLAjCQC8wJIzbSk1xz6rjiwdk44YfZOOGDsrjhg7Jxwwdk44YOyccWDsrjhh9k44YOyccMHZNkMHZWyGDsmyGDU2RYeq2QwamyGDVbIYeq2Qwam2LBqtsMPUKwwarbDBqbYsPVbYYNTEAm2GDVYhgViGHqYiGqxAamIBIBMQGpiMJiAdninRjh7K4oYfZOKGDsrihg7L4oYOycUMHZOKGDsnDFg7Jwwwdk4YYOyuGGH2Thhg7K4oYOyjVDD7KNUWDso1Qw+yjVFg7BNcMPsE1xYfZWyGHqtkWHqtkMPVFYYNVtiw9TbDBqtsMGq2ww9TbDBqisMGqIhhhxFhpiAViGBMQC4BUA9JxTqx5fZfFFg7K4o8HZOGGDsnFDB2Thhg7L4YYOycMMHZfDDB3Thiwd04YYO6cMMHdXDDD7KNMMHYJphh9gmmGH2AaosPsE1QxXYBriw+wDXDD7BNcWK7BKRYeh2RYeq2ww9QrDBqtsMPVbYsGq2wwahWGHoCsMOJAViPVbYHqsQPUxAJtiwam2GDXsBTOp4vZfDAuycMD7JxRl2VwwPsvhgOy+GBdlimA7JwwHZfDEOycMB2ThgOycMQ7KNED7ANED7BNMD7FtTA+wGpgrsWaoK7FtVFiosWa4sVFgGuGK7BNcWH2DxxYehKQw9UUhh6orDD1W2LBqisMGgKwxWgKxYehKww9CRErVQATEaYgNe/Wmbvn9FwQ0apqZUSNDwxjsnFAanFAavigNXxQGr4ohq+KA1OKIavhgNThiPVGmGjQmqA0s1RnpbVQV2LaqM4ktqoKixTVQVFi2riXFi2rhiosBq4sVFgGuGH2CUhh6EpFh6EpDD0JSGHqikWHoCsMPQFYsVoCkMPSysStCRAw4iw1QD6bXVKmXzxvDDQS9UqJAeKPQo1xhXHGNWK4BYriMXHAagqiGr4oAQqiC+KLQo1RaANVHoLaqPT0tqo9PSmqj0aW1UFaU1catKauCokpq4KixbVwVEgNcFaA1wPQlIj0JSCtAUgehKRHoCsMVoCkWHpbLEcSWywXEllYlRICIj1RED1980HQENYLeSJyX5p15XH40TGyDVdAA/QY68xW8fPYOg6GpzyR25pj2HHwb7s/V+hbBvr7geR/6mnHzb6Sjl4enrHs4RqnRrnVxw0IK4aYhXACFcNCxVFoWKotMYqi0CFMWhDTFoLamPQW1UekU1UemS1cegpq4z0pq4z0pq49PSmrgqJKauNWltXBUSApGrQFIj0BSCtCUgegKRHpbJBUSWVgrS2WLFRJbLEqJKZYLiSysWGEiI9foPp3UEdAqnuPQ9jOK/HMS87j5YmMbN0zxpoGbEcQmbYz3WZUiaRDG1tjHm9XThzj1nVWfRz4Txx6FiqPQIVRaeDFMWjBCmLTxh6t1TT6RC+ofZ8pKIq77LG9FVcjv9SQB9gcuTl6+3rLq8bxZ5p+0PD6v8QLSx4Kgi+gdlsJ/fCiZfWs9CP0/i/Lb0b8QQXCaysKp7c1WSF/3KfT6j7So5vux5f07I3jn/AGl75FDKGUhlYBlYHIZT4IPtNNeZNc9JC1MepwlqpWlhL1R6RL1StBLVx6ZLVx6CmrjPSmrjPSmSM9KZIKiS2SNWlskaokBSB6ApA9AUiVpbLA4ktlgqJLZIlRJLLBcSUyxLiS2ESoAREb69Xpz5GQR6iYzd40VdDT66xez/ADfX1mc1ifZpF5j3bk1Qb/mRmL7aLZntnGY9TmuVr9Myt83j0I8Ga0tEwztWYZxXL1I1qi08XcUrQvYQqqCSx9AO8mbYutJtORHq8/8A/eOmh9hsf/eK2ZPuO/8AaR9Wrq/Y8uez02lKWottTK9bjKOhDKw+hj7a55pNZyfd8a+P7nbqepV84qYIg9Au0H/zOe87Z7fiViOKuPPSXQkA+yfho7v0urfnCWXVoT3ygbI/gEkfxNeOfR43nUzl9Pl6dqpprjwl6o9TMEPVKiU4Q9UrSwh6o9Ih65QJZIzJZI9BTJGelMkZlskai2SM9LZIKiSykZ6WVgrQMsD0pliXElssFRJTrEqJIZYlxJTLBcAIiVr7Rpvl8zjs8yvo6Q0i2LkeZl2mJdH04tHox2aQqcTSL6ymkwFWdD7j2j9JZzsNF1qWJg9mHgwiJiTmYmPyxpVL1nEHpTJ1cVfKPxK+IGtvbQp8tdFh5GB72OBjb9AO5+uR7CYcnrL2fD4orTfmXiJLre1+CPjBtBpr6Wpe8GxbKQH2IhIw4JwcDspwB7yqbDl8jgjktE7jg/FPV/zuqbUmpaWZEV1Ri4YqMBiSPOMD+Ip923Dx/Tr13XIiaNGg0VuotSihTZbYwVFUZ/k+wHkn0iK1orGz7P0F0HpC6PR6fSr34awGb+uwks7fyxM0rGQ8Tn5PqXm3w2tXK1lhL1yolMwQ9cqJRMEPXKiUzDO9cqJIh649Ih65WkQ9cYKZJRlMkY0pkgrSmSPTLZI9MtkjVElssFaWywOJLZYKgplgrSXWC4JdYlwSyxLiQFYHr9CHRVkYnld5R9OuEV0Gs/L3HtHM6mKzWfRoZA4+vsZPsuY7Mduj7/SXFmNuNo0/TK/Ld4p5LLpwV+S9VoVU5TOPY95UXn5RfiiJ9AJRHNiij43+JvwpqKNXdrURrNLqG5GdAW4XI+ZXx4GckHx3xM5n1ep4/JE1ivzDw1YyQPcgQj1l0S91r2pq0lVVaqAifMw82WHy5M1rExMy5dm0vEXtliZnafV0wXEb7V+D7UWdPY11V131Wmm+1V+e4YDKzN58HGPHaFZeb5dZ7+/o90a5WuXqBq4aXUl65USmYIdJUSiYZ3SVEomGd0lJwh0lRKcIdJWkQ6SokiXSMFMkYKZIzKZIz0pljPS2SBlMsaimWNUSWywVBTLBUSS6xLiSnWCokhlguJL2xK19v0l1/tuH3nBaKuXjm7pVW57OpH+JjMfZ1Vt94bFrBHaZbLoisTAXoyI+yZ4wIhEepisweixauIUNKCR7ZGR9ITbIOvFswxaTU81t+MbVbag9lBI+3iTT0hXLETPo8h+LvReTpRupUBtJempcIoy1WCjHt7bg2fZTLifU+L0t/d8Z1uuL1qPYTomfRtWmS5cyaJAPtP4JafbotVnO57q7PoEKEL/PYn9iITGOLyZ20Poprk65uoWrho6kvXKiUTVmsrlxLKYZrElxLOYZ3SVEomCHWUkh0lRKSHSURLpK0imSMEskYKZYwWyQMpkjUUyxmUyw1RTLGqCWWCoKZYLiSWWJUSSywXEllYK19w0TY7ZnmXTx+jq0tmYy66tKIJGtogeyLT6oa4aOqccNHVVgYKSgy2DgE4/vFb1jFV/jOvC9U/8AnNPqLV6XotI2mOwq9ltYtd9uXZsuP+st2Hb7zSsxnqU1ifw4XxF1n4np0l92pp0OmoVdtjDitZgxChApdgxOcYxKjJnIEVq+Q6rSPUAHBUkA4PY4ms1yGsWifZmkm9J8EfD1Wv1HHbqdPp9pGEu3b7f9o7K37bgY49PX3Z8lpiPR+hOh9Fq0VC0UgkZ3O7Y32vgAsfTwAAB2AAEyvf5lzRXvaIdC5AGwM9lUN7bvP+MTPjmZ92nPStciCys0c+FOkeomGexJcSztVksSXEsZhmsSXEs5gh0lRKJgh1lJwh0lRKSXWURLLHpFMsoFMsAUyxmWyx6CnSCimWNWlMkDgl0guCWSNUFOsSoIdILiSysDfWk6l7J/JM454vywjm/DbpOoWn9KL9jM7cdY+W/HzXn2h19PdcfKj+857Vr93bS/JPvDem71EzmIbxp6rE0QrEA4jJzes9Xq0lb22BmCDJCAZ+g7nyZzX8vjpyRxe95+I/8ALq8bwuXyJyjj6rp6dV0ld2vrKVcnJp9ItjZLDID2MpGWwT28DJ8+ZnyeVeJ/hOT7O23hcXFb6do7THvPrGfiM/y8x8Wfh7pHZK0V+WzaqGu1z85IGPnJHqO82+vz1msWtE7+GnheL4nLHJM1mta+878f/fD5X8VfCtmg1FmnZgzJg9jnIIyCD6/YTpry/EsuTwa2p9Tx7dq/afSf+H2bR/A/Tdb0vp/LSFf8jptuopPDqBmoHJYfq8n9QMubZaXiTaYmR/Dfwlf0624fmrtZobKTUukuGTUdynd3OD2DDsB+qTeZtH5Ot676w9XVuI3P2ZiWI/p9h9sRVjIZclu1tERGgDCUUwU6xwzmGaxJcSytDLYkuJZTDM6S4lEwQ6SolEwQ6StThLpHEpwl0laRLJK0imWPSLZYzLZYAplgZTJHplMkNVBTpHqoJZI1EukSokl0grSykNPX3Srp9QHZB/PczzJvb7uqvDX7Nen0OP0jEytd004fs31UY8zKZdNaYaEESsgFnbwCf27f3md+WKfldeLt+Hnur67qSg/ltLW2PVrOQ/wBiZ/uKz85/s9Dg8TxZ/rvO/8Ab/l4bqHxh1hbONqtjkkKiUNuY/Qd8zaJjN7bDu/6f4mbHt/dd3U9RqxpKdUvFY91gcPgB2wvGfJ9Cwx9J50cda8/LyxO7Ef+/wDEPQ/T6cfDF5r8R6f2+XX1WtfTBaGyu0ZHtu9xFSva3aPuqPHp5MWtHtb0cu/4kK3VXN83EwYgds++Pr3/AMTs3bdpHH+lV4vFvw0n+Vt9Z+/5z4eG+NOqfnNU9wBUbQig43YGT3x9SZrvq4+HxLcHBHHadt6zOe3q9T8EfiDw10aLWqoprRKqtQmdyKBgbx6j6j+80raHleV+lTbb0n+U/D6krhlVlIZWAZWU5VlPgg+olvn7VmszE+6xGSEQASIyLYRpkl1jiWcwzukuJZzUh65USias71y9RNSHrlRKJhneuVEomCHSVqcJdI9LCmSVpYUyx6RTLDTLZI9BbJDTLZIzKZIaqCWSPVFOkNMh0iVEg44Hr75plyc+k8m0vX46ugoAmLqj0Qd4Bg1Grfd8g+UZ7kZz9ZhPJFvafR2cfFSI/lPqSOp2D9S7v4KyM1v9Hjn2nDU6kGB+Rh7nGR/zImkfKJ4M+XI6xttG05XPbv5+/pLrWI9od3jbT193h+vdItKOtb42nepOXGR4x7fv9ZrWtN3HpxyRaItX0s8h1TqnUio50exa/k5UG4Ht9/aVHj1r/T8s/wB/PDtZpn5j2cG7rDHsSQfY9jH9OU2/VIt8sj6zMfRzW8zZRbGchVGSewlRRnfy4x9v/DXqAGjr0VrHmpzt39gyN3AU+uCSP8Su9fbXg+dS1r/UiPSXs9sbhwXEYafWS2QiCZgthKTJbCNEwUyx6mYKZJUSiYIeuVEomGd0lRKJhneuVEomGd0laiYIdJUSmYIZZWpwpljiSwplj0YWyxgtlhoLZY9MtkgZTLHqimSGmU1cNMvZAPvlS4njy+grGGjJ/aSv3VZeqjEM0pvEOe+rBPpK+nX7MJ5vX3C96/SZ28WlvwuPLtX5I5xn5SR/Pb7TGfBt/pu2r+ox811G1Y8Nscf6lmf7bnj7S1jz+H7zDDqNPprM/KVJ/wC24xn9jFM81Pek/wCXbw/qNZzOSJ/uB+kaY1rWrYKg45FKhiTkk+kz/c7bZdEc9pmZmNifs4+s+D6nBLVI/wDqAVx/aafXn4le8V/eHO0v4b6C43CyodkRlKM1ZByc/pP7Rcnl8lYiYlz+RwcdesxHuy2/hdQh3UZyPAsZiQfQ59ZMfqFp/qTXi4fmrLfTfpm4bEyo7DB47Ex/Sw7EeoM6a0pyfypLq/bcVoia+kPZ/BnX3YcerywTsLjgOB6Gxfb/AFD+feXN+sxE/LzfJ8L6c9o9nu/lx4Epy+jPdWD6SoZ2iJYraMS4lz2oysspjMFsI04WyxomCWWNMwQ6SolEwQ6SolEwzOsqJTMM7pKiUTBDrKiU4SyytThTLHpYWyx6WFlYaC2WPQBljMtkgZTJAy2SBg44hr7uoE8iX0cM+p1OOwlVqi/Jjlaixj+00iHJe0ywtaB6/tNM1zTaIZ7dT9ZUVZW5GKzVt6GaRWHPPLJZ1TR9YT9SS3vYxxEJm0ypNVYv6WYfse32k34qXjLViVU5+TjnaWmP92mrqlgOWCt9R8jfcTj5P03ht/T/AB/s9Di/WfJp/VPaPy36frgB3HcGI2kkBgR+/mct/wBMv/ptsPQ4/wBb47VivJWY/s6FXUgwyNrD12nBH8H955/J4d6Tkw9Ph8vg5Y/jZi6yFsVXAw6/KVYdiv8Ajz/mVwdq+nw7+K0ROT7OV+UNbLdWCjjvgd0b3BHt+06LcnaJrb1h0TWLRm+jsfDnxFus/LWDZn/8wTlVb+gH29ptx7WI2dh5/meBNK/U452r1G4+s3eUuAIt04PiOJZ249ZrNIw9I4sytxWhldDL1jNSWWNEwU6xomGexZUSiYZ3WUiYZ3WVEpmGd1lImCXWURLLGnC2WGjCmWVpYArAAKxgDLAAKQ0y2SGgPHDRr7ZPKfRs19YGWMqGdoj3l53qOsJJVPE6KV+7zOfmmZyGAox8zTYc2TJb1tHEwmayXxGPUdVcUejqrhMNLqdVpMyZs0rx60DQCR3a/QKt0eJUXZ24sJWg57R6z6S6WmsswAe4+s5eTg4reuPR4PL56ekWMuqJHg49pj+2r8S9Cn6ny19Zhy9T0pLHDbip7Zx2hHBasej0OH9eisZMPWdHvfYEtbkx2Dn9WPr7wito93Lfn4+S20jPw6gjISiI4ETEbNfUG9O8qJxlesSxtoyTL7MJ4dGvTR6xd1x48JZ0pYRyCfGhzdV0th3HeXXkc/J40x7Of+TYnGJp2hzRxTPocvSM+Yvqto8Uu3o/tCOUp8Vhv6WR4lxyQxt48w592nK+RNItEsLUmGZll6jCysZYArAAKxgBEAArAJtiJ9kJnmPpGLWgkES6seWNhwraQDNol51qZIB7ARkNdG7eBDtEHHFa3w3UdEJ8zOeVvXw5n3aR0ISfrNY8KAt0cD0jjlKfEiCz03HgQ7p/b4RZpWEqJhnbjmF16It5hNsEcM2ak6UJP1GseKYNBiLuv6GGDTDGCJPZcccEWdOUnMqLot48SZRptviKbaunH1b65DeBxGkDTECxFxA4M3CJSiwgNItjhMs5rGcymeQogRGS8EyzWiVDOWG7ShppFmNuOJc+7pPtLjlc9vG+zBf05l+s0jkhhbhtDE9JHkTSJZTWYKZY0gKxgJWAVtgT66gnmPo4DbVmOJK1dZH0AMrsynhiTtP09B6RTeV04aw310qvgCZzMt4rEC3CLFao2R4WgZsx4mZDiMgGsGGl1gVdYhMnFYOwBJX6FNiNEhKxlgSsAiiAMgaQCwYjQmA0DRpDvhg1ZMABoADCMimECkplgmSXWUmSHWNEktGkpxApZrKgfIEqJZzWJYr9Ep8dppF5YW4oc2/TFZrFtc1qYzFZSE2w1L60s819LCzA1CBGVxSqDG8RKKMaZVGQYEIQNIAS+YpOFXQgrkJKZwaImizAKECXA0gEgFGAUYEzP5jZT7nJ4g0j2XAwNAioEW0CKaNMkPGiWW2UzsUYJKeMpKaVCXO1k0o5eVzTNXPKQQ//2Q==\" /></p>', 0, 101, 101, '2019-07-23 16:27:08', '2019-07-23 16:27:08');

-- ----------------------------
-- Table structure for yh_cart
-- ----------------------------
DROP TABLE IF EXISTS `yh_cart`;
CREATE TABLE `yh_cart`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `goods_id` int(10) NULL DEFAULT NULL COMMENT '商品id',
  `total_price` decimal(10, 2) NOT NULL COMMENT '合计总价',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '购物车表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_cart
-- ----------------------------
INSERT INTO `yh_cart` VALUES (1, NULL, NULL, 0.00, '2019-05-30 11:53:56', '2019-05-30 12:03:03');
INSERT INTO `yh_cart` VALUES (2, NULL, NULL, 0.00, '2019-05-30 12:04:24', '2019-05-30 12:05:54');

-- ----------------------------
-- Table structure for yh_categories
-- ----------------------------
DROP TABLE IF EXISTS `yh_categories`;
CREATE TABLE `yh_categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_categories
-- ----------------------------
INSERT INTO `yh_categories` VALUES (1, '招商政策', 0, '2019-05-21 14:17:54', '2019-05-21 14:17:54');
INSERT INTO `yh_categories` VALUES (2, '招商政策229', 0, '2019-05-21 14:17:54', '2019-07-20 12:27:16');

-- ----------------------------
-- Table structure for yh_check
-- ----------------------------
DROP TABLE IF EXISTS `yh_check`;
CREATE TABLE `yh_check`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL COMMENT '标题',
  `state` int(10) NULL DEFAULT NULL COMMENT '100审核中 101通过 102未通过)',
  `admin_id` int(10) NULL DEFAULT NULL COMMENT '管理员id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '审核表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_classify
-- ----------------------------
DROP TABLE IF EXISTS `yh_classify`;
CREATE TABLE `yh_classify`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) NOT NULL COMMENT '父ID',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '路径(>7>8>9>)',
  `depth` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '层极(1)',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `is_show` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '是否展示：100=不展示，101=展示',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_classify
-- ----------------------------
INSERT INTO `yh_classify` VALUES (1, 1, '', '', NULL, 0, 101, NULL, NULL);

-- ----------------------------
-- Table structure for yh_clock
-- ----------------------------
DROP TABLE IF EXISTS `yh_clock`;
CREATE TABLE `yh_clock`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `course_id` int(10) NULL DEFAULT NULL COMMENT '课程id',
  `user_id` int(10) NULL DEFAULT NULL,
  `study_time` int(10) NULL DEFAULT NULL COMMENT '学习总时长',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户现场课程打卡表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_clock
-- ----------------------------
INSERT INTO `yh_clock` VALUES (0000000001, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_clock` VALUES (0000000002, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_clock` VALUES (0000000003, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_clock` VALUES (0000000018, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_code
-- ----------------------------
DROP TABLE IF EXISTS `yh_code`;
CREATE TABLE `yh_code`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `phone` int(10) NULL DEFAULT NULL COMMENT '电话',
  `code` int(11) NULL DEFAULT NULL COMMENT '验证码',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '验证码' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_code
-- ----------------------------
INSERT INTO `yh_code` VALUES (0000000001, NULL, NULL, '2019-05-20 10:17:02');
INSERT INTO `yh_code` VALUES (0000000002, NULL, NULL, '2019-05-21 10:57:47');
INSERT INTO `yh_code` VALUES (0000000003, NULL, NULL, '2019-05-24 14:53:52');
INSERT INTO `yh_code` VALUES (0000000018, NULL, NULL, '2019-05-30 11:34:14');

-- ----------------------------
-- Table structure for yh_collect_articles
-- ----------------------------
DROP TABLE IF EXISTS `yh_collect_articles`;
CREATE TABLE `yh_collect_articles`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL COMMENT '用户id',
  `articles_id` int(10) NULL DEFAULT NULL COMMENT '文章id',
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '0正常，1已删除',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '收藏文章' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_collect_articles
-- ----------------------------
INSERT INTO `yh_collect_articles` VALUES (0000000001, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_collect_articles` VALUES (0000000002, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_collect_articles` VALUES (0000000003, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_collect_articles` VALUES (0000000018, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_collect_course
-- ----------------------------
DROP TABLE IF EXISTS `yh_collect_course`;
CREATE TABLE `yh_collect_course`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL COMMENT '用户id',
  `course_id` int(10) NULL DEFAULT NULL COMMENT '课程id',
  `subjec_id` int(10) NULL DEFAULT NULL COMMENT '科目id',
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '0正常，1已删除',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '收藏课程' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_collect_course
-- ----------------------------
INSERT INTO `yh_collect_course` VALUES (0000000001, NULL, NULL, NULL, NULL, '2019-05-20 10:17:02');
INSERT INTO `yh_collect_course` VALUES (0000000002, NULL, NULL, NULL, NULL, '2019-05-21 10:57:47');
INSERT INTO `yh_collect_course` VALUES (0000000003, NULL, NULL, NULL, NULL, '2019-05-24 14:53:52');
INSERT INTO `yh_collect_course` VALUES (0000000018, NULL, NULL, NULL, NULL, '2019-05-30 11:34:14');

-- ----------------------------
-- Table structure for yh_collect_exercises
-- ----------------------------
DROP TABLE IF EXISTS `yh_collect_exercises`;
CREATE TABLE `yh_collect_exercises`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL COMMENT '用户id',
  `exercises_id` int(10) NULL DEFAULT NULL COMMENT '习题id',
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '0正常，1已删除',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '收藏习题' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_collect_exercises
-- ----------------------------
INSERT INTO `yh_collect_exercises` VALUES (0000000001, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_collect_exercises` VALUES (0000000002, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_collect_exercises` VALUES (0000000003, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_collect_exercises` VALUES (0000000018, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_comments
-- ----------------------------
DROP TABLE IF EXISTS `yh_comments`;
CREATE TABLE `yh_comments`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `goods_id` int(10) NULL DEFAULT NULL COMMENT '商品id',
  `star_number` int(10) NULL DEFAULT NULL COMMENT '星级',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '评论内容',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '评论表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_comments
-- ----------------------------
INSERT INTO `yh_comments` VALUES (0000000001, NULL, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_comments` VALUES (0000000002, NULL, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_comments` VALUES (0000000003, NULL, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_comments` VALUES (0000000018, NULL, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_course
-- ----------------------------
DROP TABLE IF EXISTS `yh_course`;
CREATE TABLE `yh_course`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `class_id` smallint(5) NOT NULL COMMENT '分类ID',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题\r\n',
  `student_price` decimal(10, 2) NOT NULL COMMENT '学生价格',
  `employee_price` decimal(10, 2) NOT NULL COMMENT '员工价格',
  `introduce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '课程说明',
  `thumb` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '缩略图',
  `audition_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '试听链接地址',
  `period_num` int(11) NOT NULL COMMENT '总课时数',
  `total_points` int(10) NULL DEFAULT NULL COMMENT '线上考试总分数',
  `pass mark` int(10) NULL DEFAULT NULL COMMENT '线上考试及格分数',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序，数值越大越靠前',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '状态：100=关闭，101=开启',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_course_orders
-- ----------------------------
DROP TABLE IF EXISTS `yh_course_orders`;
CREATE TABLE `yh_course_orders`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `course_id` int(10) NOT NULL COMMENT '课程ID',
  `order_number` int(10) NULL DEFAULT NULL COMMENT '订单编号',
  `order_money` decimal(10, 2) NULL DEFAULT NULL COMMENT '订单金额',
  `discounts_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '经销商优惠价',
  `pay_money` decimal(10, 2) NULL DEFAULT NULL COMMENT '支付金额',
  `status` int(10) NULL DEFAULT NULL COMMENT '订单状态：100=未付款,104=已完成，105=已取消',
  `pay_type` smallint(3) NULL DEFAULT NULL COMMENT '支付类型：100=微信支付,101=支付宝',
  `aw_order` int(10) NULL DEFAULT NULL COMMENT '微信，支付宝订单号',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '订单备注',
  `expired_at` timestamp(0) NULL DEFAULT NULL COMMENT '过期时间',
  `paid_at` timestamp(0) NULL DEFAULT NULL COMMENT '支付时间',
  `deal_done_at` timestamp(0) NULL DEFAULT NULL COMMENT '交易完成时间',
  `distributor_id` int(10) NULL DEFAULT NULL COMMENT '经销商id',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '课程订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_course_orders
-- ----------------------------
INSERT INTO `yh_course_orders` VALUES (1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 11:53:56', '2019-05-30 12:03:03');
INSERT INTO `yh_course_orders` VALUES (2, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 12:04:24', '2019-05-30 12:05:54');

-- ----------------------------
-- Table structure for yh_course_study
-- ----------------------------
DROP TABLE IF EXISTS `yh_course_study`;
CREATE TABLE `yh_course_study`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `course_id` int(10) NULL DEFAULT NULL COMMENT '课程id',
  `subjec_id` int(10) NULL DEFAULT NULL COMMENT '科目id',
  `period_id` int(10) NULL DEFAULT NULL COMMENT '课时id',
  `period_time` int(11) NULL DEFAULT NULL COMMENT '课时总时长',
  `study_time` int(10) NULL DEFAULT NULL COMMENT '学习总时长',
  `state` smallint(3) NULL DEFAULT NULL COMMENT '100已学完 101未学完 ',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户课程学习表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_course_study
-- ----------------------------
INSERT INTO `yh_course_study` VALUES (0000000001, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_course_study` VALUES (0000000002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_course_study` VALUES (0000000003, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_course_study` VALUES (0000000018, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_distributor
-- ----------------------------
DROP TABLE IF EXISTS `yh_distributor`;
CREATE TABLE `yh_distributor`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` smallint(3) NULL DEFAULT NULL COMMENT '100正常  101禁用 102删除',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '经销商表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_distributor_preferential
-- ----------------------------
DROP TABLE IF EXISTS `yh_distributor_preferential`;
CREATE TABLE `yh_distributor_preferential`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `distributor_id` int(10) NULL DEFAULT NULL COMMENT '经销商id',
  `course_id` int(10) NULL DEFAULT NULL COMMENT '课程id',
  `subjec_id` int(10) NULL DEFAULT NULL COMMENT '科目id',
  `referral_code` int(10) NULL DEFAULT NULL COMMENT '推荐码',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '优惠价格',
  `state` smallint(3) NULL DEFAULT NULL COMMENT '100正常  101禁用 102删除',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '经销商课程优惠表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_exam
-- ----------------------------
DROP TABLE IF EXISTS `yh_exam`;
CREATE TABLE `yh_exam`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `course_id` int(10) NULL DEFAULT NULL COMMENT '课程id',
  `subjec_id` int(10) NULL DEFAULT NULL COMMENT '科目id',
  `total_points` int(10) NULL DEFAULT NULL COMMENT '总分',
  `pass_mark` int(10) NULL DEFAULT NULL COMMENT '及格分',
  `state` smallint(3) NULL DEFAULT NULL COMMENT '100正常  101禁用 102删除',
  `exam_time` timestamp(0) NULL DEFAULT NULL COMMENT '考试时间',
  `provinces_id` int(10) NULL DEFAULT NULL COMMENT '省id',
  `city_id` int(10) NULL DEFAULT NULL COMMENT '市id',
  `district_id` int(10) NULL DEFAULT NULL COMMENT '区id',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详情地址',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '现场考试表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_examination_venues
-- ----------------------------
DROP TABLE IF EXISTS `yh_examination_venues`;
CREATE TABLE `yh_examination_venues`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `provinces_id` int(10) NULL DEFAULT NULL COMMENT '省id',
  `city_id` int(10) NULL DEFAULT NULL COMMENT '市id',
  `district_id` int(10) NULL DEFAULT NULL COMMENT '区id',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详细地址',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '现场考试地点' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_exercises
-- ----------------------------
DROP TABLE IF EXISTS `yh_exercises`;
CREATE TABLE `yh_exercises`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` int(10) NULL DEFAULT NULL COMMENT '课程id',
  `subjec_id` int(10) NULL DEFAULT NULL COMMENT '科目id',
  `stem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '题干',
  `options` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '候选答案',
  `type` int(255) NULL DEFAULT NULL COMMENT '100单选题，101多选题，102判断题',
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '正确答案',
  `analyzing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '解析',
  `state` smallint(3) NULL DEFAULT NULL COMMENT '100正常 101禁用 102删除',
  `genre` int(255) NULL DEFAULT NULL COMMENT '100必会题库 101九阳真经 102模拟考试 103真实考试',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `menus_name_unique`(`stem`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 146 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '习题表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_exercises
-- ----------------------------
INSERT INTO `yh_exercises` VALUES (10, NULL, NULL, '仪表盘', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10 22:04:03', '2018-08-18 23:10:04');
INSERT INTO `yh_exercises` VALUES (11, NULL, NULL, '权限管理', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10 22:05:12', '2018-08-18 23:17:20');
INSERT INTO `yh_exercises` VALUES (12, NULL, NULL, '系统首页', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10 22:06:56', '2017-10-10 22:08:34');
INSERT INTO `yh_exercises` VALUES (14, NULL, NULL, '管理员列表', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10 22:09:33', '2017-10-10 22:09:33');
INSERT INTO `yh_exercises` VALUES (15, NULL, NULL, '角色列表', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10 22:10:08', '2017-10-10 22:10:08');
INSERT INTO `yh_exercises` VALUES (16, NULL, NULL, '权限列表', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10 22:10:44', '2017-10-10 22:10:44');
INSERT INTO `yh_exercises` VALUES (17, NULL, NULL, '资源列表', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10 22:14:32', '2017-10-10 22:14:32');
INSERT INTO `yh_exercises` VALUES (19, NULL, NULL, '日志管理', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-10 22:28:56', '2017-10-10 22:28:56');
INSERT INTO `yh_exercises` VALUES (34, NULL, NULL, '登录日志', NULL, NULL, NULL, NULL, NULL, NULL, '2017-10-26 13:45:04', '2017-10-26 13:52:17');
INSERT INTO `yh_exercises` VALUES (37, NULL, NULL, '用户管理', NULL, NULL, NULL, NULL, NULL, NULL, '2018-01-03 21:43:03', '2018-08-18 23:10:26');
INSERT INTO `yh_exercises` VALUES (64, NULL, NULL, '系统设置', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-27 11:37:22', '2018-03-27 11:37:22');
INSERT INTO `yh_exercises` VALUES (65, NULL, NULL, '消息管理', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-27 11:46:17', '2018-08-18 23:19:14');
INSERT INTO `yh_exercises` VALUES (69, NULL, NULL, '数据统计', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-27 11:53:59', '2018-08-18 23:33:45');
INSERT INTO `yh_exercises` VALUES (70, NULL, NULL, '广告管理', NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-27 11:57:54', '2019-05-16 11:22:08');
INSERT INTO `yh_exercises` VALUES (72, NULL, NULL, '用户列表', NULL, NULL, NULL, NULL, NULL, NULL, '2018-04-02 23:26:02', '2018-04-02 23:26:02');
INSERT INTO `yh_exercises` VALUES (101, NULL, NULL, '文章管理', NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-18 23:23:53', '2018-08-18 23:23:53');
INSERT INTO `yh_exercises` VALUES (106, NULL, NULL, '消息列表', NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-19 23:18:40', '2018-08-19 23:18:40');
INSERT INTO `yh_exercises` VALUES (108, NULL, NULL, '广告列表', NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-20 22:12:42', '2018-08-20 22:12:42');
INSERT INTO `yh_exercises` VALUES (110, NULL, NULL, '文章列表', NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-21 16:46:51', '2018-08-21 16:46:51');
INSERT INTO `yh_exercises` VALUES (111, NULL, NULL, '分类列表', NULL, NULL, NULL, NULL, NULL, NULL, '2018-08-21 16:47:32', '2018-08-21 16:47:32');
INSERT INTO `yh_exercises` VALUES (123, NULL, NULL, '商品管理', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-16 23:57:30', '2019-05-16 23:57:30');
INSERT INTO `yh_exercises` VALUES (124, NULL, NULL, '采购管理', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-16 23:59:03', '2019-05-16 23:59:03');
INSERT INTO `yh_exercises` VALUES (125, NULL, NULL, '商务管理', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 00:00:03', '2019-05-17 00:00:03');
INSERT INTO `yh_exercises` VALUES (126, NULL, NULL, '订单管理', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 00:01:00', '2019-05-17 00:01:00');
INSERT INTO `yh_exercises` VALUES (127, NULL, NULL, '财务管理', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 00:02:35', '2019-05-17 00:02:35');
INSERT INTO `yh_exercises` VALUES (128, NULL, NULL, '认证管理', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 00:03:19', '2019-05-17 00:03:19');
INSERT INTO `yh_exercises` VALUES (129, NULL, NULL, '发货管理', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 00:04:03', '2019-05-17 00:04:03');
INSERT INTO `yh_exercises` VALUES (130, NULL, NULL, '供货商列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 09:32:20', '2019-05-17 09:32:20');
INSERT INTO `yh_exercises` VALUES (131, NULL, NULL, '商品模板库列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 10:21:08', '2019-05-17 10:21:08');
INSERT INTO `yh_exercises` VALUES (132, NULL, NULL, '平台采购订单列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-17 14:54:46', '2019-05-17 15:22:42');
INSERT INTO `yh_exercises` VALUES (133, NULL, NULL, '平台模板商品库列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-18 09:43:55', '2019-05-18 09:43:55');
INSERT INTO `yh_exercises` VALUES (134, NULL, NULL, '合伙人商品列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-18 16:00:43', '2019-05-18 16:00:43');
INSERT INTO `yh_exercises` VALUES (135, NULL, NULL, '合伙人等级列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-19 11:11:23', '2019-05-19 11:11:23');
INSERT INTO `yh_exercises` VALUES (136, NULL, NULL, '订单列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-19 23:44:16', '2019-05-19 23:44:35');
INSERT INTO `yh_exercises` VALUES (137, NULL, NULL, '发货单列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 10:19:40', '2019-05-20 10:19:40');
INSERT INTO `yh_exercises` VALUES (138, NULL, NULL, '退货申请列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 16:21:11', '2019-05-20 16:21:11');
INSERT INTO `yh_exercises` VALUES (139, NULL, NULL, '实名认证申请列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 17:34:45', '2019-05-20 17:34:45');
INSERT INTO `yh_exercises` VALUES (140, NULL, NULL, '加盟申请列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-21 16:51:43', '2019-05-21 16:51:43');
INSERT INTO `yh_exercises` VALUES (141, NULL, NULL, '区域招商记录列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-22 23:33:27', '2019-05-22 23:33:27');
INSERT INTO `yh_exercises` VALUES (142, NULL, NULL, '服务管理', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-23 10:46:07', '2019-05-23 10:46:07');
INSERT INTO `yh_exercises` VALUES (143, NULL, NULL, '标签列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-23 10:46:30', '2019-05-23 10:46:30');
INSERT INTO `yh_exercises` VALUES (144, NULL, NULL, '平台标语列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-23 11:39:04', '2019-05-23 11:39:04');
INSERT INTO `yh_exercises` VALUES (145, NULL, NULL, '服务保障列表', NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-23 14:12:07', '2019-05-23 14:12:07');

-- ----------------------------
-- Table structure for yh_goods
-- ----------------------------
DROP TABLE IF EXISTS `yh_goods`;
CREATE TABLE `yh_goods`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名称',
  `subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '商品副标题',
  `sku_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品编号',
  `price` decimal(10, 2) NOT NULL COMMENT '商品价格',
  `pricing_schemes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '价格方案：[{xxx:aaaa},{xxx:bbbb}]',
  `inventory` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '库存',
  `pre_discount_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '折前价',
  `cost_price` decimal(8, 2) NOT NULL COMMENT '成本价',
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品缩略图',
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品相册',
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品属性，[{key:xx,value:xx}',
  `detail_ext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '富文本详情',
  `is_sale` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '是否上架：100=上架，101=下架',
  `is_recommend` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '是否推荐：100=不推荐，101=推荐',
  `is_hot` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '是否为热销：100=不是,101=是',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_images
-- ----------------------------
DROP TABLE IF EXISTS `yh_images`;
CREATE TABLE `yh_images`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT '上传图片用户ID',
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片路径',
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '图片分类',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `images_user_id_index`(`user_id`) USING BTREE,
  INDEX `images_path_index`(`path`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 149 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_images
-- ----------------------------
INSERT INTO `yh_images` VALUES (24, 3, 'realName/QLArEPD9LsmZa35FRiRgZXYON0woXb5GxYdTlbjZ.jpeg', 'realName', '2019-05-29 10:34:39', '2019-05-29 10:34:39');
INSERT INTO `yh_images` VALUES (25, 3, 'realNameJust/1R4sAKZSihmT1nVoJb1mUzkJjqN3KFj2hU8B3xap.jpeg', 'realNameJust', '2019-05-29 11:06:43', '2019-05-29 11:06:43');
INSERT INTO `yh_images` VALUES (26, 3, 'realName/uXfjMAJXugcWeziKzoNzerglzTAIsZ4VakerzExr.jpeg', 'realName', '2019-05-29 11:43:21', '2019-05-29 11:43:21');
INSERT INTO `yh_images` VALUES (86, 1, 'abc/MhWc8HfHIrhDk30hcLQaqgYHaFDChgU3ryjoc913.jpeg', 'abc', '2019-07-21 17:05:50', '2019-07-21 17:05:50');
INSERT INTO `yh_images` VALUES (87, 1, 'abc/40f3MgDaAglPaYWjZnHM8HV9Z1i3czmuwMTuuqE0.jpeg', 'abc', '2019-07-21 17:06:34', '2019-07-21 17:06:34');
INSERT INTO `yh_images` VALUES (88, 1, 'abc/fXkKj1R8bjQKXh7vtgPpaxxWAwqh9lVWpb57JQCX.jpeg', 'abc', '2019-07-21 17:08:41', '2019-07-21 17:08:41');
INSERT INTO `yh_images` VALUES (89, 1, 'abc/Oi6y59zII4bWpoNvQaplMjZYxPktf8mup5ysdg8R.jpeg', 'abc', '2019-07-21 17:08:57', '2019-07-21 17:08:57');
INSERT INTO `yh_images` VALUES (90, 1, 'abc/E4dv0WjZJlKPJiNjNUb4h2hORvrX1gt5J8jON2jo.jpeg', 'abc', '2019-07-21 17:10:16', '2019-07-21 17:10:16');
INSERT INTO `yh_images` VALUES (91, 1, 'abc/MzmVjv9lUXJ7yu7wiMsnMVsqUUq5V4MnLjLsjLqB.jpeg', 'abc', '2019-07-21 17:10:45', '2019-07-21 17:10:45');
INSERT INTO `yh_images` VALUES (92, 1, 'abc/DMVfBZ95FkZrZAPAO6pJRdEzS88BTEPd4GggHMVY.jpeg', 'abc', '2019-07-21 17:16:07', '2019-07-21 17:16:07');
INSERT INTO `yh_images` VALUES (93, 1, 'abc/rpRwlOEZIHP2HAkLb1OC76f3IW8d3FFdmp4QntBW.jpeg', 'abc', '2019-07-21 17:20:05', '2019-07-21 17:20:05');
INSERT INTO `yh_images` VALUES (94, 1, 'abc/YZKSzrGzi7MBXnv4CEKOgAwrSzCyGt5N1RZAGQnz.jpeg', 'abc', '2019-07-21 17:20:55', '2019-07-21 17:20:55');
INSERT INTO `yh_images` VALUES (95, 1, 'abc/CxbdIhkaZme84mgODS89bM7utlTKaBEski1PJL6c.jpeg', 'abc', '2019-07-21 17:21:32', '2019-07-21 17:21:32');
INSERT INTO `yh_images` VALUES (96, 1, 'abc/bXRZubVQ3zQYhIBgVsEpnnRkVeo1ot4pymwxokJZ.jpeg', 'abc', '2019-07-21 17:22:32', '2019-07-21 17:22:32');
INSERT INTO `yh_images` VALUES (97, 1, 'abc/TwADla8tDoJwanxNmr7dOdkP9oeSPKc4woffCMmf.jpeg', 'abc', '2019-07-21 17:26:04', '2019-07-21 17:26:04');
INSERT INTO `yh_images` VALUES (98, 1, 'abc/TCTu4EeATnhiXeEgbBkku8x9H0NKa6HZXRaoO3EL.jpeg', 'abc', '2019-07-21 17:26:32', '2019-07-21 17:26:32');
INSERT INTO `yh_images` VALUES (99, 1, 'abc/QcPLjvIgXJiRUPgJILp1RTTIm9Jd9zpFVGNf8fVN.jpeg', 'abc', '2019-07-21 17:27:28', '2019-07-21 17:27:28');
INSERT INTO `yh_images` VALUES (100, 1, 'abc/cQaTNIm6cLlh8gk02pnTQOx7kLcLo0RLFdGDVscf.jpeg', 'abc', '2019-07-21 17:32:24', '2019-07-21 17:32:24');
INSERT INTO `yh_images` VALUES (101, 1, 'abc/bUGEGOR6mmfPFXXxiq0nFIsmrpVBVegV1HYyAbde.jpeg', 'abc', '2019-07-21 17:39:07', '2019-07-21 17:39:07');
INSERT INTO `yh_images` VALUES (102, 1, 'abc/JgMZTgAUHR8NslBPe4viEAJzsk0nQHXcCoNUVxZG.jpeg', 'abc', '2019-07-21 18:07:33', '2019-07-21 18:07:33');
INSERT INTO `yh_images` VALUES (103, 1, 'abc/LOqkbe6fKWqPeGcY3fWNlhLiovaQozqVYdR8khw0.jpeg', 'abc', '2019-07-21 18:10:32', '2019-07-21 18:10:32');
INSERT INTO `yh_images` VALUES (104, 1, 'abc/2fIZ59KDoHOD3Cw6uZji42mqiJTcNpty08ZK8DrD.jpeg', 'abc', '2019-07-21 18:14:06', '2019-07-21 18:14:06');
INSERT INTO `yh_images` VALUES (105, 1, 'abc/CYhkv0JCln57AjkVvsYQCVLsvyUbN0WKBlMjrED8.jpeg', 'abc', '2019-07-21 18:16:23', '2019-07-21 18:16:23');
INSERT INTO `yh_images` VALUES (106, 1, 'abc/GT2kDUYKJR6K4nc3TdFnNjipBkBWohx2icPeYOF0.jpeg', 'abc', '2019-07-21 18:36:49', '2019-07-21 18:36:49');
INSERT INTO `yh_images` VALUES (107, 1, 'abc/pQ9TdAXqLarfUfVg0UwTJzChRrPUM0Jaqf2jxnL6.jpeg', 'abc', '2019-07-21 18:59:38', '2019-07-21 18:59:38');
INSERT INTO `yh_images` VALUES (108, 1, 'abc/BdjdiJKr7sc5ip4C7sxLgKj1jBfSQaBKAV2ok1qF.jpeg', 'abc', '2019-07-21 19:00:55', '2019-07-21 19:00:55');
INSERT INTO `yh_images` VALUES (109, 1, 'abc/M8Je0bxX0XQubrXdPLJfSPhgJqOK0HftBTSz5CVu.jpeg', 'abc', '2019-07-21 20:34:30', '2019-07-21 20:34:30');
INSERT INTO `yh_images` VALUES (110, 1, 'abc/5NzN2B8bAsLlcl1K5SZCfjp45TcgTajgVTc4NK22.jpeg', 'abc', '2019-07-21 20:43:55', '2019-07-21 20:43:55');
INSERT INTO `yh_images` VALUES (111, 1, 'abc/JBzsbGHAvy8rKXvAczAVGCohL9qLf1UAk3PRaVep.jpeg', 'abc', '2019-07-21 20:50:34', '2019-07-21 20:50:34');
INSERT INTO `yh_images` VALUES (112, 1, 'abc/iFPOwZRJePypSsBFLdRB06pIBvlj6KY5M1gaABHr.jpeg', 'abc', '2019-07-21 20:52:18', '2019-07-21 20:52:18');
INSERT INTO `yh_images` VALUES (113, 1, 'abc/kU8JiWZUh5HykhIplMIQjwJ29dMVS2za8cvISnTp.jpeg', 'abc', '2019-07-21 21:08:57', '2019-07-21 21:08:57');
INSERT INTO `yh_images` VALUES (114, 1, 'abc/iLI5oLNZsCkPEOLIJNzKvmZ1gFDii19VpOfJYP70.jpeg', 'abc', '2019-07-21 21:14:34', '2019-07-21 21:14:34');
INSERT INTO `yh_images` VALUES (115, 1, 'abc/hXBrl5QqeXac2pb65V3yLeFBRVlB3O87z2lo4NnB.jpeg', 'abc', '2019-07-21 21:14:53', '2019-07-21 21:14:53');
INSERT INTO `yh_images` VALUES (116, 1, 'abc/Y7sMuHQOccgdrDZuzGPp0XIoCB8DDzPJQszKUSNH.jpeg', 'abc', '2019-07-21 21:17:08', '2019-07-21 21:17:08');
INSERT INTO `yh_images` VALUES (117, 1, 'abc/9jS44Pj34euLfhPxfLD5aWWAhH23IIlr5sImywdC.jpeg', 'abc', '2019-07-21 21:19:57', '2019-07-21 21:19:57');
INSERT INTO `yh_images` VALUES (118, 1, 'abc/vlArZ5JrsvbMg0NbbyaUf6UxBQuDTZAJVDsIp9f0.jpeg', 'abc', '2019-07-21 21:21:00', '2019-07-21 21:21:00');
INSERT INTO `yh_images` VALUES (119, 1, 'abc/eVxiIH9Ja7KON4FGBReTJRAhnxzmYKwQNIdHGThr.jpeg', 'abc', '2019-07-21 21:26:45', '2019-07-21 21:26:45');
INSERT INTO `yh_images` VALUES (120, 1, 'abc/xIpCNw7KqgW5ut0BvFmj1IMhabSZrb5PYxLBVgSh.jpeg', 'abc', '2019-07-21 21:28:26', '2019-07-21 21:28:26');
INSERT INTO `yh_images` VALUES (121, 1, 'abc/38OEvtIMXFHj0d27M0v0oj5zy8GaATLns9EX3DJb.jpeg', 'abc', '2019-07-21 21:30:53', '2019-07-21 21:30:53');
INSERT INTO `yh_images` VALUES (122, 1, 'abc/FpCVJW5dsq9dRRiRYKgGkt33lxVKRhfctvQ0XQ6n.jpeg', 'abc', '2019-07-21 21:37:47', '2019-07-21 21:37:47');
INSERT INTO `yh_images` VALUES (123, 1, 'abc/UKDbo4QGJgn9BEpYXJK1oIFc6eTu4M0jqF92TXUv.jpeg', 'abc', '2019-07-21 21:38:17', '2019-07-21 21:38:17');
INSERT INTO `yh_images` VALUES (124, 1, 'abc/Qt4bYZjPTZeEvAq8l6xRjIjWx8xZk139TmhwHKjl.jpeg', 'abc', '2019-07-21 21:40:07', '2019-07-21 21:40:07');
INSERT INTO `yh_images` VALUES (125, 1, 'abc/4E03iWhTNyhthzPV5S0viD6IUhq6W5pFIb6g1cbc.jpeg', 'abc', '2019-07-21 22:13:54', '2019-07-21 22:13:54');
INSERT INTO `yh_images` VALUES (126, 1, 'abc/dK3XnEOWvTcQa1Th4xazvggu9LVfU4PVv1PKDqvf.jpeg', 'abc', '2019-07-21 22:14:02', '2019-07-21 22:14:02');
INSERT INTO `yh_images` VALUES (127, 1, 'abc/1nUzYO1QakZBkYaCgUXBeoud42g8mj0JLj3qy3pZ.jpeg', 'abc', '2019-07-22 14:31:20', '2019-07-22 14:31:20');
INSERT INTO `yh_images` VALUES (128, 1, 'abc/aiSnrOL3ynOcIyzEwcQavxKMz3IM6ZmxmJzGJIFv.jpeg', 'abc', '2019-07-22 14:34:58', '2019-07-22 14:34:58');
INSERT INTO `yh_images` VALUES (129, 1, 'abc/qW7ZNgMcX5o0hEi0rOzDzXFM74Z5zdKXOlqOpC9I.jpeg', 'abc', '2019-07-22 14:37:52', '2019-07-22 14:37:52');
INSERT INTO `yh_images` VALUES (130, 1, 'abc/iztu6vrng0kHg6hm8sEU0KTmFnJLOlvuvxQpY2Hd.jpeg', 'abc', '2019-07-22 14:42:07', '2019-07-22 14:42:07');
INSERT INTO `yh_images` VALUES (131, 1, 'abc/ZsZMxo2ld7IzRdAG6iiz1JXjShwSlrGAPOV5gVw8.jpeg', 'abc', '2019-07-22 14:52:34', '2019-07-22 14:52:34');
INSERT INTO `yh_images` VALUES (132, 1, 'abc/5PLwuksVmzM5JFSX5mIIuuK715yWttdoH1VkFcFP.jpeg', 'abc', '2019-07-22 15:32:23', '2019-07-22 15:32:23');
INSERT INTO `yh_images` VALUES (133, 1, 'abc/UWPEV0JSD6PHl0Lc3xbv8xCayuAt2KeGbMouGWMf.jpeg', 'abc', '2019-07-22 15:32:26', '2019-07-22 15:32:26');
INSERT INTO `yh_images` VALUES (134, 1, 'abc/e0GPbRYkfCm4rXTxK9cRzXjuCmrihUPL254YNBCC.jpeg', 'abc', '2019-07-22 15:36:56', '2019-07-22 15:36:56');
INSERT INTO `yh_images` VALUES (135, 1, 'abc/Kz7LMv4HWYna6vcdqcmlMZxTHMuiplz8d0GmJ72P.jpeg', 'abc', '2019-07-22 15:48:31', '2019-07-22 15:48:31');
INSERT INTO `yh_images` VALUES (136, 1, 'abc/eXLHxsj1HW2C5OGJPlssYpmHc33xyhyLMwo0WJwX.jpeg', 'abc', '2019-07-22 15:50:36', '2019-07-22 15:50:36');
INSERT INTO `yh_images` VALUES (137, 1, 'abc/7H6hrTAPW3x0FTED7lXhNognTLdsZPGwKZ6c83ld.jpeg', 'abc', '2019-07-22 15:55:33', '2019-07-22 15:55:33');
INSERT INTO `yh_images` VALUES (138, 1, 'abc/XFowcHE89NAqLYBdF9DoEivVQqEQxZt3tCsZzlFG.jpeg', 'abc', '2019-07-22 16:00:40', '2019-07-22 16:00:40');
INSERT INTO `yh_images` VALUES (139, 1, 'abc/RVXGagBmLOiwcUzf59s6QK5MwKdJU7sbZsivEOXj.jpeg', 'abc', '2019-07-22 16:02:53', '2019-07-22 16:02:53');
INSERT INTO `yh_images` VALUES (140, 1, 'abc/dZDtjVmUdkXEiBBgYaSkZKjEZNbpZ0epwPZYru53.jpeg', 'abc', '2019-07-22 16:03:10', '2019-07-22 16:03:10');
INSERT INTO `yh_images` VALUES (141, 1, 'abc/hyQojwqctCvxcoZOah3UPXyqIyUCYLWEKnSBGb0Y.jpeg', 'abc', '2019-07-22 16:07:23', '2019-07-22 16:07:23');
INSERT INTO `yh_images` VALUES (142, 1, 'abc/38EPf5hIVhzpQvDId9ODKNXEsdYrCshy4tUGoZOe.jpeg', 'abc', '2019-07-22 16:22:43', '2019-07-22 16:22:43');
INSERT INTO `yh_images` VALUES (143, 1, 'abc/WZyUCDn4eOiLYgrc7AwanPcv0D2I6MlF7bKs8brN.jpeg', 'abc', '2019-07-22 16:24:33', '2019-07-22 16:24:33');
INSERT INTO `yh_images` VALUES (144, 1, 'abc/rVQXNVAV10GESIzvKGadC8cgOgZMvspIxKGSJfrF.jpeg', 'abc', '2019-07-22 18:58:29', '2019-07-22 18:58:29');
INSERT INTO `yh_images` VALUES (145, 1, 'abc/93cPR2xvMqp2PEy76NdYoKk4j4xCR53quycwE2K3.jpeg', 'abc', '2019-07-22 19:00:31', '2019-07-22 19:00:31');
INSERT INTO `yh_images` VALUES (146, 1, 'abc/7rJfmZUOFSWLGXL3zCVWgqfN4yQegDQaPwYnqFhj.jpeg', 'abc', '2019-07-22 19:02:37', '2019-07-22 19:02:37');
INSERT INTO `yh_images` VALUES (147, 1, 'abc/4GVYa1V7bgzXY86CyOcnNMh1mdKD4rwpb9Nwmb4o.jpeg', 'abc', '2019-07-22 22:58:26', '2019-07-22 22:58:26');
INSERT INTO `yh_images` VALUES (148, 1, 'abc/8J4u8vcGUSGZzZFc2g2UoevgUkavMggF5erzGsO7.jpeg', 'abc', '2019-07-23 14:09:49', '2019-07-23 14:09:49');

-- ----------------------------
-- Table structure for yh_login_logs
-- ----------------------------
DROP TABLE IF EXISTS `yh_login_logs`;
CREATE TABLE `yh_login_logs`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ip` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录IP',
  `location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '登录地区',
  `time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '登录时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_login_logs
-- ----------------------------
INSERT INTO `yh_login_logs` VALUES (1, 1, '127.0.0.1', 'Localhost', '2019-05-25 16:56:21');
INSERT INTO `yh_login_logs` VALUES (2, 1, '127.0.0.1', 'Localhost', '2019-05-25 22:33:00');
INSERT INTO `yh_login_logs` VALUES (3, 1, '127.0.0.1', 'Localhost', '2019-05-26 16:11:02');
INSERT INTO `yh_login_logs` VALUES (4, 1, '127.0.0.1', 'Localhost', '2019-05-29 16:57:34');
INSERT INTO `yh_login_logs` VALUES (5, 1, '127.0.0.1', 'Localhost', '2019-05-30 15:44:53');
INSERT INTO `yh_login_logs` VALUES (6, 1, '127.0.0.1', 'Localhost', '2019-06-29 21:15:03');
INSERT INTO `yh_login_logs` VALUES (7, 1, '127.0.0.1', 'Localhost', '2019-06-29 22:55:59');
INSERT INTO `yh_login_logs` VALUES (8, 1, '127.0.0.1', 'Localhost', '2019-06-29 23:19:28');
INSERT INTO `yh_login_logs` VALUES (9, 1, '127.0.0.1', 'Localhost', '2019-06-30 07:41:16');
INSERT INTO `yh_login_logs` VALUES (10, 1, '127.0.0.1', 'Localhost', '2019-06-30 09:34:53');
INSERT INTO `yh_login_logs` VALUES (11, 1, '127.0.0.1', 'Localhost', '2019-06-30 13:48:45');
INSERT INTO `yh_login_logs` VALUES (12, 1, '127.0.0.1', 'Localhost', '2019-06-30 13:49:59');
INSERT INTO `yh_login_logs` VALUES (13, 1, '127.0.0.1', 'Localhost', '2019-06-30 13:50:07');
INSERT INTO `yh_login_logs` VALUES (14, 1, '127.0.0.1', 'Localhost', '2019-06-30 13:52:49');
INSERT INTO `yh_login_logs` VALUES (15, 1, '127.0.0.1', 'Localhost', '2019-06-30 13:53:03');
INSERT INTO `yh_login_logs` VALUES (16, 1, '127.0.0.1', 'Localhost', '2019-07-01 15:29:50');
INSERT INTO `yh_login_logs` VALUES (17, 1, '127.0.0.1', 'Localhost', '2019-07-02 14:53:05');
INSERT INTO `yh_login_logs` VALUES (18, 1, '127.0.0.1', 'Localhost', '2019-07-02 14:53:19');
INSERT INTO `yh_login_logs` VALUES (19, 1, '127.0.0.1', 'Localhost', '2019-07-02 14:54:04');
INSERT INTO `yh_login_logs` VALUES (20, 1, '127.0.0.1', 'Localhost', '2019-07-04 07:54:26');
INSERT INTO `yh_login_logs` VALUES (21, 1, '127.0.0.1', 'Localhost', '2019-07-04 07:55:06');
INSERT INTO `yh_login_logs` VALUES (22, 1, '127.0.0.1', 'Localhost', '2019-07-04 07:56:34');
INSERT INTO `yh_login_logs` VALUES (23, 1, '127.0.0.1', 'Localhost', '2019-07-04 07:58:54');
INSERT INTO `yh_login_logs` VALUES (24, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:00:27');
INSERT INTO `yh_login_logs` VALUES (25, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:00:58');
INSERT INTO `yh_login_logs` VALUES (26, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:01:43');
INSERT INTO `yh_login_logs` VALUES (27, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:03:15');
INSERT INTO `yh_login_logs` VALUES (28, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:04:41');
INSERT INTO `yh_login_logs` VALUES (29, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:04:55');
INSERT INTO `yh_login_logs` VALUES (30, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:05:06');
INSERT INTO `yh_login_logs` VALUES (31, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:05:28');
INSERT INTO `yh_login_logs` VALUES (32, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:05:51');
INSERT INTO `yh_login_logs` VALUES (33, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:06:13');
INSERT INTO `yh_login_logs` VALUES (34, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:06:36');
INSERT INTO `yh_login_logs` VALUES (35, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:07:03');
INSERT INTO `yh_login_logs` VALUES (36, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:07:32');
INSERT INTO `yh_login_logs` VALUES (37, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:10:22');
INSERT INTO `yh_login_logs` VALUES (38, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:30:11');
INSERT INTO `yh_login_logs` VALUES (39, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:31:02');
INSERT INTO `yh_login_logs` VALUES (40, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:32:22');
INSERT INTO `yh_login_logs` VALUES (41, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:42:32');
INSERT INTO `yh_login_logs` VALUES (42, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:52:21');
INSERT INTO `yh_login_logs` VALUES (43, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:57:43');
INSERT INTO `yh_login_logs` VALUES (44, 1, '127.0.0.1', 'Localhost', '2019-07-04 08:57:48');

-- ----------------------------
-- Table structure for yh_menus
-- ----------------------------
DROP TABLE IF EXISTS `yh_menus`;
CREATE TABLE `yh_menus`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '资源名称',
  `link` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT '资源链接',
  `permission` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '资源权限',
  `permission_id` int(10) NULL DEFAULT NULL COMMENT '权限id',
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级资源ID',
  `icon` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '资源图标',
  `sort` smallint(3) UNSIGNED NULL DEFAULT 0 COMMENT '排序',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '路由',
  `component` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '组件',
  `redirect` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '面包屑重定向地址',
  `v_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '展示名称',
  `meta` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `menus_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 183 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_menus
-- ----------------------------
INSERT INTO `yh_menus` VALUES (180, '权限管理', NULL, NULL, NULL, 0, 'table', 1, '2019-07-17 22:23:54', '2019-07-17 22:23:54', '/permission-manage', 'layout/Layout', '/permission-manage/permission-list', 'permissionManage', '权限管理', '{\"title\":\"\\u6743\\u9650\\u7ba1\\u7406\",\"icon\":\"table\"}');
INSERT INTO `yh_menus` VALUES (181, '资源列表', NULL, 'menu.index', 24, 180, NULL, 2, '2019-07-17 22:26:12', '2019-07-17 22:26:12', 'resources-list', 'views/permission-manage/resources-list', NULL, 'resourcesList', '资源列表', '{\"title\":\"\\u8d44\\u6e90\\u5217\\u8868\"}');
INSERT INTO `yh_menus` VALUES (182, '权限列表', NULL, 'permission.index', 9, 180, NULL, 3, '2019-07-17 22:28:57', '2019-07-17 22:28:57', 'permission-list', 'views/permission-manage/permission-list', NULL, 'permissionList', '权限列表', '{\"title\":\"\\u6743\\u9650\\u5217\\u8868\"}');

-- ----------------------------
-- Table structure for yh_message_class
-- ----------------------------
DROP TABLE IF EXISTS `yh_message_class`;
CREATE TABLE `yh_message_class`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分类名称',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `is_show` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '是否展示：100=不展示，101=展示',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_message_class
-- ----------------------------
INSERT INTO `yh_message_class` VALUES (1, '1', 0, 101, NULL, NULL);

-- ----------------------------
-- Table structure for yh_messages
-- ----------------------------
DROP TABLE IF EXISTS `yh_messages`;
CREATE TABLE `yh_messages`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED NOT NULL COMMENT '消息分类id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '消息标题',
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '消息内容',
  `is_push` int(10) NULL DEFAULT NULL COMMENT '100不推送，101推送',
  `type` int(10) NULL DEFAULT NULL COMMENT '(类型 100弹窗  101消息中心)',
  `target` int(10) NULL DEFAULT NULL COMMENT '对象100学生 101会员',
  `state` int(10) NULL DEFAULT NULL COMMENT '(100正常 101禁用 102删除)',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_online_exam
-- ----------------------------
DROP TABLE IF EXISTS `yh_online_exam`;
CREATE TABLE `yh_online_exam`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `course_id` int(10) NULL DEFAULT NULL COMMENT '课程id',
  `subjec_id` int(10) NULL DEFAULT NULL COMMENT '科目id',
  `total_points` int(10) NULL DEFAULT NULL COMMENT '总分',
  `pass_mark` int(10) NULL DEFAULT NULL COMMENT '及格分',
  `state` smallint(3) NULL DEFAULT NULL COMMENT '100正常  101禁用 102删除',
  `question_num` int(10) NULL DEFAULT NULL COMMENT '题目数量',
  `exam_time` timestamp(0) NULL DEFAULT NULL COMMENT '考试时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '线上考试表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `yh_order_goods`;
CREATE TABLE `yh_order_goods`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `shop_order_id` int(10) NULL DEFAULT NULL COMMENT '订单id',
  `goods_id` int(10) NULL DEFAULT NULL COMMENT '商品id',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '单价',
  `number` int(10) NULL DEFAULT NULL COMMENT '数量',
  `subtotal` decimal(10, 2) NULL DEFAULT NULL COMMENT '小计价格',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '订单商品表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_order_goods
-- ----------------------------
INSERT INTO `yh_order_goods` VALUES (0000000001, NULL, NULL, NULL, NULL, NULL, '2019-05-20 10:17:02');
INSERT INTO `yh_order_goods` VALUES (0000000002, NULL, NULL, NULL, NULL, NULL, '2019-05-21 10:57:47');
INSERT INTO `yh_order_goods` VALUES (0000000003, NULL, NULL, NULL, NULL, NULL, '2019-05-24 14:53:52');
INSERT INTO `yh_order_goods` VALUES (0000000018, NULL, NULL, NULL, NULL, NULL, '2019-05-30 11:34:14');

-- ----------------------------
-- Table structure for yh_order_subject
-- ----------------------------
DROP TABLE IF EXISTS `yh_order_subject`;
CREATE TABLE `yh_order_subject`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `course_order_id` int(10) NULL DEFAULT NULL COMMENT '课程订单ID',
  `subjec_id` int(10) NULL DEFAULT NULL COMMENT '科目ID',
  `price` decimal(10, 2) NULL DEFAULT NULL COMMENT '价格',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '订单科目表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_order_subject
-- ----------------------------
INSERT INTO `yh_order_subject` VALUES (0000000001, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_order_subject` VALUES (0000000002, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_order_subject` VALUES (0000000003, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_order_subject` VALUES (0000000018, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_period
-- ----------------------------
DROP TABLE IF EXISTS `yh_period`;
CREATE TABLE `yh_period`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` smallint(5) NOT NULL COMMENT '课程id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '课时标题',
  `introduce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '课时说明',
  `total_time` int(11) NOT NULL COMMENT '总时长',
  `play_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '播放地址',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序，数值越大越靠前',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '状态：100=关闭，101=开启',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '课时' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `yh_permission_role`;
CREATE TABLE `yh_permission_role`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `permission_role_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `yh_permission_role_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `yh_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `yh_permission_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `yh_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_permission_role
-- ----------------------------
INSERT INTO `yh_permission_role` VALUES (1, 1);
INSERT INTO `yh_permission_role` VALUES (2, 1);
INSERT INTO `yh_permission_role` VALUES (4, 1);
INSERT INTO `yh_permission_role` VALUES (6, 1);
INSERT INTO `yh_permission_role` VALUES (7, 2);
INSERT INTO `yh_permission_role` VALUES (8, 2);
INSERT INTO `yh_permission_role` VALUES (9, 2);
INSERT INTO `yh_permission_role` VALUES (1, 28);

-- ----------------------------
-- Table structure for yh_permissions
-- ----------------------------
DROP TABLE IF EXISTS `yh_permissions`;
CREATE TABLE `yh_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 361 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_permissions
-- ----------------------------
INSERT INTO `yh_permissions` VALUES (1, 'index.index', '后台首页', '后台起始页包含统计信息', '2017-09-21 23:51:17', '2017-09-21 23:51:17');
INSERT INTO `yh_permissions` VALUES (2, 'admin.index', '管理员列表', '展示管理员列表信息', '2017-09-21 23:52:53', '2017-09-21 23:52:53');
INSERT INTO `yh_permissions` VALUES (4, 'admin.store', '添加管理员', '添加管理员，入库', '2017-09-21 23:54:56', '2017-09-21 23:54:56');
INSERT INTO `yh_permissions` VALUES (6, 'admin.edit', '编辑管理员', '编辑管理员', '2017-09-22 00:06:01', '2017-09-22 00:06:01');
INSERT INTO `yh_permissions` VALUES (7, 'admin.update', '更新管理员', '更新管理员', '2017-09-22 00:06:22', '2017-09-22 00:06:22');
INSERT INTO `yh_permissions` VALUES (8, 'admin.destroy', '删除管理员', '删除管理员', '2017-09-22 00:06:47', '2017-09-22 00:06:47');
INSERT INTO `yh_permissions` VALUES (9, 'permission.index', '权限列表', '权限列表', '2017-09-22 00:08:15', '2017-09-22 00:08:15');
INSERT INTO `yh_permissions` VALUES (11, 'permission.store', '添加权限', '添加权限', '2017-09-22 00:10:09', '2017-09-22 00:10:09');
INSERT INTO `yh_permissions` VALUES (13, 'permission.edit', '编辑权限', '编辑权限', '2017-09-22 00:11:17', '2017-09-22 00:11:17');
INSERT INTO `yh_permissions` VALUES (14, 'permission.update', '更新权限', '更新权限', '2017-09-22 00:11:36', '2017-09-22 00:11:36');
INSERT INTO `yh_permissions` VALUES (15, 'permission.destroy', '删除权限', '删除权限', '2017-09-22 00:12:23', '2017-09-22 00:12:23');
INSERT INTO `yh_permissions` VALUES (16, 'role.index', '角色列表', '角色列表', '2017-09-22 00:16:10', '2017-09-22 00:16:10');
INSERT INTO `yh_permissions` VALUES (18, 'role.store', '添加角色', '添加角色', '2017-09-22 00:17:11', '2017-09-22 00:17:11');
INSERT INTO `yh_permissions` VALUES (20, 'role.edit', '编辑权限', '编辑权限', '2017-09-22 00:18:04', '2017-09-22 00:18:04');
INSERT INTO `yh_permissions` VALUES (22, 'role.update', '更新角色', '更新角色', '2017-09-22 00:19:13', '2017-09-22 00:19:13');
INSERT INTO `yh_permissions` VALUES (23, 'role.destroy', '删除角色', '删除角色', '2017-09-22 00:19:45', '2017-09-22 00:19:45');
INSERT INTO `yh_permissions` VALUES (24, 'menu.index', '资源列表', '资源列表', '2017-09-22 00:22:25', '2017-09-22 00:22:25');
INSERT INTO `yh_permissions` VALUES (26, 'menu.store', '添加资源', '添加资源', '2017-09-22 00:23:52', '2017-09-22 00:23:52');
INSERT INTO `yh_permissions` VALUES (28, 'menu.edit', '编辑资源', '编辑资源', '2017-09-22 00:24:55', '2017-09-22 00:24:55');
INSERT INTO `yh_permissions` VALUES (29, 'menu.update', '更新资源', '更新资源', '2017-09-22 00:26:06', '2017-09-22 00:26:06');
INSERT INTO `yh_permissions` VALUES (30, 'menu.destroy', '删除资源', '删除资源', '2017-09-22 00:26:42', '2017-09-22 00:26:42');
INSERT INTO `yh_permissions` VALUES (31, 'system.index', '系统设置', '系统设置', '2017-09-22 00:29:52', '2017-10-11 10:20:43');
INSERT INTO `yh_permissions` VALUES (38, 'system.update', '更新系统设置', '更新系统设置', '2017-10-26 13:56:46', '2017-10-26 13:56:46');
INSERT INTO `yh_permissions` VALUES (60, 'index.flush', '清除缓存', '清除缓存', '2017-10-26 15:44:23', '2017-10-26 15:44:23');
INSERT INTO `yh_permissions` VALUES (66, 'log.index', '登录日志列表', '登录日志列表', '2017-10-26 15:47:19', '2017-10-26 15:47:19');
INSERT INTO `yh_permissions` VALUES (67, 'log.destroy', '删除登录日志', '删除登录日志', '2017-10-26 15:47:47', '2017-10-26 15:47:47');
INSERT INTO `yh_permissions` VALUES (83, 'index.profile', '个人设置', '个人设置', '2017-11-02 22:33:08', '2017-11-02 22:33:08');
INSERT INTO `yh_permissions` VALUES (84, 'index.update_profile', '更新个人设置', '更新个人设置', '2017-11-02 22:33:34', '2017-11-02 22:33:34');
INSERT INTO `yh_permissions` VALUES (88, 'user.index', '会员列表', '会员列表', '2018-01-05 14:07:51', '2018-01-05 14:07:51');
INSERT INTO `yh_permissions` VALUES (89, 'user.store', '添加会员', '添加会员', '2018-01-05 14:08:26', '2018-01-05 14:08:26');
INSERT INTO `yh_permissions` VALUES (90, 'user.edit', '编辑会员', '编辑会员', '2018-01-05 14:08:53', '2018-01-05 14:08:53');
INSERT INTO `yh_permissions` VALUES (91, 'user.update', '更新会员', '更新会员', '2018-01-05 14:09:11', '2018-01-05 14:09:11');
INSERT INTO `yh_permissions` VALUES (92, 'user.destroy', '删除会员', '删除会员', '2018-01-05 14:09:47', '2018-01-05 14:09:47');
INSERT INTO `yh_permissions` VALUES (216, 'message.index', '消息列表', '消息列表', '2018-08-19 23:17:03', '2018-08-19 23:17:03');
INSERT INTO `yh_permissions` VALUES (217, 'message.store', '添加消息', '添加消息', '2018-08-19 23:17:26', '2018-08-19 23:17:26');
INSERT INTO `yh_permissions` VALUES (218, 'message.destroy', '删除消息', '删除消息', '2018-08-19 23:17:54', '2018-08-19 23:17:54');
INSERT INTO `yh_permissions` VALUES (222, 'ad.index', '广告列表', '广告列表', '2018-08-20 22:09:21', '2018-08-20 22:09:21');
INSERT INTO `yh_permissions` VALUES (223, 'ad.store', '添加广告', '添加广告', '2018-08-20 22:10:25', '2018-08-20 22:10:25');
INSERT INTO `yh_permissions` VALUES (224, 'ad.edit', '编辑广告', '编辑广告', '2018-08-20 22:10:43', '2018-08-20 22:10:43');
INSERT INTO `yh_permissions` VALUES (225, 'ad.update', '更新广告', '更新广告', '2018-08-20 22:11:02', '2018-08-20 22:11:02');
INSERT INTO `yh_permissions` VALUES (226, 'ad.destroy', '删除广告', '删除广告', '2018-08-20 22:11:24', '2018-08-20 22:11:24');
INSERT INTO `yh_permissions` VALUES (232, 'category.index', '分类列表', '分类列表', '2018-08-21 16:20:33', '2018-08-21 16:20:33');
INSERT INTO `yh_permissions` VALUES (233, 'category.store', '添加分类', '添加分类', '2018-08-21 16:20:58', '2018-08-21 16:20:58');
INSERT INTO `yh_permissions` VALUES (234, 'category.edit', '编辑分类', '编辑分类', '2018-08-21 16:21:23', '2018-08-21 16:21:23');
INSERT INTO `yh_permissions` VALUES (235, 'category.update', '更新分类', '更新分类', '2018-08-21 16:21:55', '2018-08-21 16:21:55');
INSERT INTO `yh_permissions` VALUES (236, 'category.destroy', '删除分类', '删除分类', '2018-08-21 16:22:18', '2018-08-21 16:22:18');
INSERT INTO `yh_permissions` VALUES (237, 'article.index', '文章列表', '文章列表', '2018-08-21 16:23:01', '2018-08-21 16:23:01');
INSERT INTO `yh_permissions` VALUES (238, 'article.store', '添加文章', '添加文章', '2018-08-21 16:41:06', '2018-08-21 16:41:06');
INSERT INTO `yh_permissions` VALUES (239, 'article.edit', '编辑文章', '编辑文章', '2018-08-21 16:41:30', '2018-08-21 16:41:30');
INSERT INTO `yh_permissions` VALUES (240, 'article.update', '更新文章', '更新文章', '2018-08-21 16:45:37', '2018-08-21 16:45:37');
INSERT INTO `yh_permissions` VALUES (241, 'article.destroy', '删除文章', '删除文章', '2018-08-21 16:46:08', '2018-08-21 16:46:08');
INSERT INTO `yh_permissions` VALUES (290, 'supplier.index', '供货商列表', '供货商列表', '2019-05-17 09:30:28', '2019-05-17 09:30:28');
INSERT INTO `yh_permissions` VALUES (291, 'supplier.store', '添加供货商', '添加供货商', '2019-05-17 09:30:48', '2019-05-17 10:19:34');
INSERT INTO `yh_permissions` VALUES (292, 'supplier.edit', '编辑供货商', '编辑供货商', '2019-05-17 09:31:05', '2019-05-17 09:31:05');
INSERT INTO `yh_permissions` VALUES (293, 'supplier.update', '更新供货商', '更新供货商', '2019-05-17 09:31:20', '2019-05-17 09:31:20');
INSERT INTO `yh_permissions` VALUES (294, 'supplier.destroy', '删除供货商', '删除供货商', '2019-05-17 09:31:33', '2019-05-17 09:31:33');
INSERT INTO `yh_permissions` VALUES (295, 'template_goods.index', '商品模板库列表', '商品模板库列表', '2019-05-17 10:18:32', '2019-05-17 10:18:32');
INSERT INTO `yh_permissions` VALUES (296, 'template_goods.store', '添加商品模板库', '添加商品模板库', '2019-05-17 10:18:56', '2019-05-17 10:18:56');
INSERT INTO `yh_permissions` VALUES (297, 'template_goods.edit', '编辑商品模板库', '编辑商品模板库', '2019-05-17 10:19:56', '2019-05-17 10:19:56');
INSERT INTO `yh_permissions` VALUES (298, 'template_goods.update', '更新商品模板库', '更新商品模板库', '2019-05-17 10:20:11', '2019-05-17 10:20:11');
INSERT INTO `yh_permissions` VALUES (299, 'template_goods.destroy', '删除商品模板库', '删除商品模板库', '2019-05-17 10:20:27', '2019-05-17 10:20:27');
INSERT INTO `yh_permissions` VALUES (300, 'platform_purchase_records.index', '平台采购/进货记录列表', '平台采购/进货记录列表', '2019-05-17 14:52:10', '2019-05-17 14:52:10');
INSERT INTO `yh_permissions` VALUES (302, 'platform_purchase_records.edit', '编辑平台采购/进货记录', '编辑平台采购/进货记录', '2019-05-17 14:53:03', '2019-05-17 14:53:03');
INSERT INTO `yh_permissions` VALUES (303, 'platform_purchase_records.update', '更新平台采购/进货记录', '更新平台采购/进货记录', '2019-05-17 14:53:26', '2019-05-17 14:53:26');
INSERT INTO `yh_permissions` VALUES (305, 'platform_purchase_order.index', '平台采购订单列表', '平台采购订单列表', '2019-05-17 15:20:40', '2019-05-17 15:20:40');
INSERT INTO `yh_permissions` VALUES (306, 'platform_purchase_order.store', '添加平台采购订单', '添加平台采购订单', '2019-05-17 15:20:57', '2019-05-17 15:20:57');
INSERT INTO `yh_permissions` VALUES (307, 'platform_purchase_order.edit', '编辑平台采购订单', '编辑平台采购订单', '2019-05-17 15:21:16', '2019-05-17 15:21:16');
INSERT INTO `yh_permissions` VALUES (308, 'platform_purchase_order.update', '更新平台采购订单', '更新平台采购订单', '2019-05-17 15:21:42', '2019-05-17 15:21:42');
INSERT INTO `yh_permissions` VALUES (309, 'platform_purchase_order.destroy', '删除平台采购订单', '删除平台采购订单', '2019-05-17 15:21:58', '2019-05-17 15:21:58');
INSERT INTO `yh_permissions` VALUES (310, 'platform_template_goods.index', '平台模板商品库列表', '平台模板商品库列表', '2019-05-18 09:41:43', '2019-05-18 09:41:43');
INSERT INTO `yh_permissions` VALUES (311, 'platform_template_goods.edit', '编辑平台模板商品库', '编辑平台模板商品库', '2019-05-18 09:42:09', '2019-05-18 09:42:09');
INSERT INTO `yh_permissions` VALUES (312, 'platform_template_goods.update', '更新平台模板商品库', '更新平台模板商品库', '2019-05-18 09:42:34', '2019-05-18 09:42:34');
INSERT INTO `yh_permissions` VALUES (313, 'platform_template_goods.destroy', '删除平台模板商品库', '删除平台模板商品库', '2019-05-18 09:43:04', '2019-05-18 09:43:04');
INSERT INTO `yh_permissions` VALUES (314, 'partner_goods.index', '合伙人商品列表', '合伙人商品列表', '2019-05-18 15:59:22', '2019-05-18 15:59:22');
INSERT INTO `yh_permissions` VALUES (315, 'partner_goods.edit', '编辑合伙人商品', '编辑合伙人商品', '2019-05-18 15:59:42', '2019-05-18 15:59:42');
INSERT INTO `yh_permissions` VALUES (316, 'partner_goods.update', '更新合伙人商品', '更新合伙人商品', '2019-05-18 15:59:57', '2019-05-18 15:59:57');
INSERT INTO `yh_permissions` VALUES (317, 'partner_goods.destroy', '删除合伙人商品', '删除合伙人商品', '2019-05-18 16:00:11', '2019-05-18 16:00:11');
INSERT INTO `yh_permissions` VALUES (318, 'partner_level.index', '合伙人等级列表', '合伙人等级列表', '2019-05-19 11:06:46', '2019-05-19 11:06:46');
INSERT INTO `yh_permissions` VALUES (319, 'partner_level.store', '添加合伙人等级', '添加合伙人等级', '2019-05-19 11:06:59', '2019-05-19 11:06:59');
INSERT INTO `yh_permissions` VALUES (320, 'partner_level.edit', '编辑合伙人等级', '编辑合伙人等级', '2019-05-19 11:07:34', '2019-05-19 11:07:34');
INSERT INTO `yh_permissions` VALUES (321, 'partner_level.update', '更新合伙人等级', '更新合伙人等级', '2019-05-19 11:08:12', '2019-05-19 11:08:12');
INSERT INTO `yh_permissions` VALUES (322, 'partner_level.destroy', '删除合伙人等级', '删除合伙人等级', '2019-05-19 11:08:29', '2019-05-19 11:08:29');
INSERT INTO `yh_permissions` VALUES (323, 'order.index', '订单列表', '订单列表', '2019-05-19 23:41:32', '2019-05-19 23:41:32');
INSERT INTO `yh_permissions` VALUES (324, 'order.store', '添加订单', '添加订单', '2019-05-19 23:41:58', '2019-05-19 23:41:58');
INSERT INTO `yh_permissions` VALUES (325, 'order.edit', '编辑订单', '编辑订单', '2019-05-19 23:43:01', '2019-05-19 23:43:01');
INSERT INTO `yh_permissions` VALUES (326, 'order.update', '更新订单', '更新订单', '2019-05-19 23:43:14', '2019-05-19 23:43:14');
INSERT INTO `yh_permissions` VALUES (327, 'order.destroy', '删除订单', '删除订单', '2019-05-19 23:43:28', '2019-05-19 23:43:28');
INSERT INTO `yh_permissions` VALUES (328, 'shipments.index', '发货单列表', '发货单列表', '2019-05-20 10:17:58', '2019-05-20 10:17:58');
INSERT INTO `yh_permissions` VALUES (329, 'shipments.edit', '编辑发货单', '编辑发货单', '2019-05-20 10:18:11', '2019-05-20 10:18:11');
INSERT INTO `yh_permissions` VALUES (330, 'shipments.update', '更新发货单', '更新发货单', '2019-05-20 10:18:26', '2019-05-20 10:18:26');
INSERT INTO `yh_permissions` VALUES (331, 'shipments.destroy', '删除发货单', '删除发货单', '2019-05-20 10:18:39', '2019-05-20 10:18:39');
INSERT INTO `yh_permissions` VALUES (332, 'sales_return_records.index', '退货申请列表', '退货申请列表', '2019-05-20 16:20:05', '2019-05-20 16:20:05');
INSERT INTO `yh_permissions` VALUES (333, 'sales_return_records.edit', '编辑退货申请', '编辑退货申请', '2019-05-20 16:20:26', '2019-05-20 16:20:26');
INSERT INTO `yh_permissions` VALUES (334, 'sales_return_records.update', '更新退货申请', '更新退货申请', '2019-05-20 16:20:41', '2019-05-20 16:20:41');
INSERT INTO `yh_permissions` VALUES (335, 'authentication.index', '实名认证列表', '实名认证列表', '2019-05-20 17:32:55', '2019-05-20 17:32:55');
INSERT INTO `yh_permissions` VALUES (336, 'authentication.edit', '编辑实名认证', '编辑实名认证', '2019-05-20 17:33:28', '2019-05-20 17:33:28');
INSERT INTO `yh_permissions` VALUES (337, 'authentication.update', '更新实名认证', '更新实名认证', '2019-05-20 17:33:44', '2019-05-20 17:33:44');
INSERT INTO `yh_permissions` VALUES (338, 'authentication.destroy', '删除实名认证', '删除实名认证', '2019-05-20 17:34:01', '2019-05-20 17:34:01');
INSERT INTO `yh_permissions` VALUES (339, 'join_apply_records.index', '加盟申请列表1', '加盟申请列表1', '2019-05-21 16:50:19', '2019-07-23 15:34:56');
INSERT INTO `yh_permissions` VALUES (340, 'join_apply_records.edit', '编辑加盟申请', '编辑加盟申请', '2019-05-21 16:50:39', '2019-05-21 16:50:39');
INSERT INTO `yh_permissions` VALUES (341, 'join_apply_records.update', '更新加盟申请', '更新加盟申请', '2019-05-21 16:50:54', '2019-05-21 16:50:54');
INSERT INTO `yh_permissions` VALUES (342, 'join_apply_records.destroy', '删除加盟申请1', '删除加盟申请1', '2019-05-21 16:51:09', '2019-07-23 15:34:35');
INSERT INTO `yh_permissions` VALUES (343, 'flagship_store_records.index', '区域招商记录列表', '区域招商记录列表', '2019-05-22 23:32:29', '2019-05-22 23:32:29');
INSERT INTO `yh_permissions` VALUES (345, 'label.index', '标签列表', '标签列表', '2019-05-23 10:43:07', '2019-05-23 10:43:07');
INSERT INTO `yh_permissions` VALUES (346, 'label.store', '添加标签', '添加标签', '2019-05-23 10:43:21', '2019-05-23 10:43:21');
INSERT INTO `yh_permissions` VALUES (347, 'label.edit', '编辑标签', '编辑标签', '2019-05-23 10:43:43', '2019-05-23 10:43:43');
INSERT INTO `yh_permissions` VALUES (348, 'label.update', '更新标签', '更新标签', '2019-05-23 10:43:57', '2019-05-23 10:43:57');
INSERT INTO `yh_permissions` VALUES (349, 'label.destroy', '删除标签', '删除标签', '2019-05-23 10:44:14', '2019-05-23 10:44:14');
INSERT INTO `yh_permissions` VALUES (350, 'platform_slogan.index', '平台标语列表', '平台标语列表', '2019-05-23 11:37:05', '2019-05-23 11:37:05');
INSERT INTO `yh_permissions` VALUES (351, 'platform_slogan.store', '添加平台标语', '添加平台标语', '2019-05-23 11:37:31', '2019-05-23 11:37:31');
INSERT INTO `yh_permissions` VALUES (352, 'platform_slogan.edit', '编辑平台标语', '编辑平台标语', '2019-05-23 11:37:47', '2019-05-23 11:37:47');
INSERT INTO `yh_permissions` VALUES (353, 'platform_slogan.update', '更新平台标语', '更新平台标语', '2019-05-23 11:38:01', '2019-05-23 11:38:01');
INSERT INTO `yh_permissions` VALUES (354, 'platform_slogan.destroy', '删除平台标语', '删除平台标语', '2019-05-23 11:38:18', '2019-05-23 11:38:18');
INSERT INTO `yh_permissions` VALUES (355, 'service_tips.index', '服务保障列表', '服务保障列表', '2019-05-23 14:10:19', '2019-05-23 14:10:19');
INSERT INTO `yh_permissions` VALUES (356, 'service_tips.store', '添加服务保障', '添加服务保障', '2019-05-23 14:10:35', '2019-05-23 14:10:35');
INSERT INTO `yh_permissions` VALUES (357, 'service_tips.edit', '编辑服务保障', '编辑服务保障', '2019-05-23 14:10:48', '2019-05-23 14:10:48');
INSERT INTO `yh_permissions` VALUES (358, 'service_tips.update', '更新服务保障', '更新服务保障', '2019-05-23 14:11:02', '2019-05-23 14:11:02');
INSERT INTO `yh_permissions` VALUES (359, 'service_tips.destroy', '删除服务保障', '删除服务保障', '2019-05-23 14:11:15', '2019-05-23 14:11:15');

-- ----------------------------
-- Table structure for yh_practice
-- ----------------------------
DROP TABLE IF EXISTS `yh_practice`;
CREATE TABLE `yh_practice`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `course_id` int(10) NULL DEFAULT NULL COMMENT '课程id',
  `subjec_id` int(10) NULL DEFAULT NULL COMMENT '科目id',
  `type` smallint(3) NULL DEFAULT NULL COMMENT '100必会题库 101九阳真经 102模拟考试',
  `question_num` int(10) NULL DEFAULT NULL COMMENT '题目数量',
  `correct_num` int(10) NULL DEFAULT NULL COMMENT '答对题目数量',
  `exercises_id` int(10) NULL DEFAULT NULL COMMENT '已答到题id',
  `spend` int(10) NULL DEFAULT NULL COMMENT '回答所有题目的用时',
  `finish_time` timestamp(0) NULL DEFAULT NULL COMMENT '提交时间。为空表示本次练习没有完成，也即没有交卷。每个人没有完成的练习，始终只有一个。只有交卷之后，才能创建新的练习',
  `accuracy` int(10) NULL DEFAULT NULL COMMENT '正确率',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '练习表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_practice
-- ----------------------------
INSERT INTO `yh_practice` VALUES (0000000001, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `yh_practice` VALUES (0000000002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `yh_practice` VALUES (0000000003, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `yh_practice` VALUES (0000000018, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for yh_practice_exercises
-- ----------------------------
DROP TABLE IF EXISTS `yh_practice_exercises`;
CREATE TABLE `yh_practice_exercises`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `practice_id` int(10) NULL DEFAULT NULL COMMENT '练习表id',
  `execrcises_id` int(10) NULL DEFAULT NULL COMMENT '习题id',
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '题目的正确答案',
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '每道题静默提交时更新：用户提交的答案',
  `is_correct` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '每道题静默提交时更新：答案是否正确',
  `spend` int(10) NULL DEFAULT NULL COMMENT '每道题静默提交时更新：本题用时秒数',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '练习-习题表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_practice_exercises
-- ----------------------------
INSERT INTO `yh_practice_exercises` VALUES (0000000001, NULL, NULL, '', NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_practice_exercises` VALUES (0000000002, NULL, NULL, '', NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_practice_exercises` VALUES (0000000003, NULL, NULL, '', NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_practice_exercises` VALUES (0000000018, NULL, NULL, '', NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_quiz_exercises
-- ----------------------------
DROP TABLE IF EXISTS `yh_quiz_exercises`;
CREATE TABLE `yh_quiz_exercises`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `course_id` int(10) NOT NULL COMMENT '课程ID',
  `period_id` int(10) NOT NULL COMMENT '课时id',
  `subjec_id` int(11) NULL DEFAULT NULL COMMENT '科目id',
  `stem` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '题干',
  `options` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '候选答案',
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '100单选题，101多选题，102判断题',
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '正确答案',
  `analyzing` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '解析',
  `state` int(255) NULL DEFAULT NULL COMMENT '100正常 101禁用 102删除',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序，数值越大越靠前',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '随堂习题表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_regions
-- ----------------------------
DROP TABLE IF EXISTS `yh_regions`;
CREATE TABLE `yh_regions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` mediumint(8) UNSIGNED NOT NULL,
  `parent_code` mediumint(8) UNSIGNED NULL DEFAULT 0,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `letter` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '字母索引',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3316 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_regions
-- ----------------------------
INSERT INTO `yh_regions` VALUES (1, 110000, 86, '北京市', 'B');
INSERT INTO `yh_regions` VALUES (2, 120000, 86, '天津市', 'T');
INSERT INTO `yh_regions` VALUES (3, 130000, 86, '河北省', 'H');
INSERT INTO `yh_regions` VALUES (4, 140000, 86, '山西省', 'S');
INSERT INTO `yh_regions` VALUES (5, 150000, 86, '内蒙古自治区', 'N');
INSERT INTO `yh_regions` VALUES (6, 210000, 86, '辽宁省', 'L');
INSERT INTO `yh_regions` VALUES (7, 220000, 86, '吉林省', 'J');
INSERT INTO `yh_regions` VALUES (8, 230000, 86, '黑龙江省', 'H');
INSERT INTO `yh_regions` VALUES (9, 310000, 86, '上海市', 'S');
INSERT INTO `yh_regions` VALUES (10, 320000, 86, '江苏省', 'J');
INSERT INTO `yh_regions` VALUES (11, 330000, 86, '浙江省', 'Z');
INSERT INTO `yh_regions` VALUES (12, 340000, 86, '安徽省', 'A');
INSERT INTO `yh_regions` VALUES (13, 350000, 86, '福建省', 'F');
INSERT INTO `yh_regions` VALUES (14, 360000, 86, '江西省', 'J');
INSERT INTO `yh_regions` VALUES (15, 370000, 86, '山东省', 'S');
INSERT INTO `yh_regions` VALUES (16, 410000, 86, '河南省', 'H');
INSERT INTO `yh_regions` VALUES (17, 420000, 86, '湖北省', 'H');
INSERT INTO `yh_regions` VALUES (18, 430000, 86, '湖南省', 'H');
INSERT INTO `yh_regions` VALUES (19, 440000, 86, '广东省', 'G');
INSERT INTO `yh_regions` VALUES (20, 450000, 86, '广西壮族自治区', 'G');
INSERT INTO `yh_regions` VALUES (21, 460000, 86, '海南省', 'H');
INSERT INTO `yh_regions` VALUES (22, 500000, 86, '重庆市', 'C');
INSERT INTO `yh_regions` VALUES (23, 510000, 86, '四川省', 'S');
INSERT INTO `yh_regions` VALUES (24, 520000, 86, '贵州省', 'G');
INSERT INTO `yh_regions` VALUES (25, 530000, 86, '云南省', 'Y');
INSERT INTO `yh_regions` VALUES (26, 540000, 86, '西藏自治区', 'X');
INSERT INTO `yh_regions` VALUES (27, 610000, 86, '陕西省', 'S');
INSERT INTO `yh_regions` VALUES (28, 620000, 86, '甘肃省', 'G');
INSERT INTO `yh_regions` VALUES (29, 630000, 86, '青海省', 'Q');
INSERT INTO `yh_regions` VALUES (30, 640000, 86, '宁夏回族自治区', 'N');
INSERT INTO `yh_regions` VALUES (31, 650000, 86, '新疆维吾尔自治区', 'X');
INSERT INTO `yh_regions` VALUES (32, 710000, 86, '台湾省', 'T');
INSERT INTO `yh_regions` VALUES (33, 810000, 86, '香港特别行政区', 'X');
INSERT INTO `yh_regions` VALUES (34, 820000, 86, '澳门特别行政区', 'A');
INSERT INTO `yh_regions` VALUES (35, 110100, 110000, '北京城区', NULL);
INSERT INTO `yh_regions` VALUES (36, 110101, 110100, '东城区', NULL);
INSERT INTO `yh_regions` VALUES (37, 110102, 110100, '西城区', NULL);
INSERT INTO `yh_regions` VALUES (38, 110105, 110100, '朝阳区', NULL);
INSERT INTO `yh_regions` VALUES (39, 110106, 110100, '丰台区', NULL);
INSERT INTO `yh_regions` VALUES (40, 110107, 110100, '石景山区', NULL);
INSERT INTO `yh_regions` VALUES (41, 110108, 110100, '海淀区', NULL);
INSERT INTO `yh_regions` VALUES (42, 110109, 110100, '门头沟区', NULL);
INSERT INTO `yh_regions` VALUES (43, 110111, 110100, '房山区', NULL);
INSERT INTO `yh_regions` VALUES (44, 110112, 110100, '通州区', NULL);
INSERT INTO `yh_regions` VALUES (45, 110113, 110100, '顺义区', NULL);
INSERT INTO `yh_regions` VALUES (46, 110114, 110100, '昌平区', NULL);
INSERT INTO `yh_regions` VALUES (47, 110115, 110100, '大兴区', NULL);
INSERT INTO `yh_regions` VALUES (48, 110116, 110100, '怀柔区', NULL);
INSERT INTO `yh_regions` VALUES (49, 110117, 110100, '平谷区', NULL);
INSERT INTO `yh_regions` VALUES (50, 110118, 110100, '密云区', NULL);
INSERT INTO `yh_regions` VALUES (51, 110119, 110100, '延庆区', NULL);
INSERT INTO `yh_regions` VALUES (52, 120100, 120000, '天津城区', NULL);
INSERT INTO `yh_regions` VALUES (53, 120101, 120100, '和平区', NULL);
INSERT INTO `yh_regions` VALUES (54, 120102, 120100, '河东区', NULL);
INSERT INTO `yh_regions` VALUES (55, 120103, 120100, '河西区', NULL);
INSERT INTO `yh_regions` VALUES (56, 120104, 120100, '南开区', NULL);
INSERT INTO `yh_regions` VALUES (57, 120105, 120100, '河北区', NULL);
INSERT INTO `yh_regions` VALUES (58, 120106, 120100, '红桥区', NULL);
INSERT INTO `yh_regions` VALUES (59, 120110, 120100, '东丽区', NULL);
INSERT INTO `yh_regions` VALUES (60, 120111, 120100, '西青区', NULL);
INSERT INTO `yh_regions` VALUES (61, 120112, 120100, '津南区', NULL);
INSERT INTO `yh_regions` VALUES (62, 120113, 120100, '北辰区', NULL);
INSERT INTO `yh_regions` VALUES (63, 120114, 120100, '武清区', NULL);
INSERT INTO `yh_regions` VALUES (64, 120115, 120100, '宝坻区', NULL);
INSERT INTO `yh_regions` VALUES (65, 120116, 120100, '滨海新区', NULL);
INSERT INTO `yh_regions` VALUES (66, 120117, 120100, '宁河区', NULL);
INSERT INTO `yh_regions` VALUES (67, 120118, 120100, '静海区', NULL);
INSERT INTO `yh_regions` VALUES (68, 120119, 120100, '蓟州区', NULL);
INSERT INTO `yh_regions` VALUES (69, 130100, 130000, '石家庄市', NULL);
INSERT INTO `yh_regions` VALUES (70, 130200, 130000, '唐山市', NULL);
INSERT INTO `yh_regions` VALUES (71, 130300, 130000, '秦皇岛市', NULL);
INSERT INTO `yh_regions` VALUES (72, 130400, 130000, '邯郸市', NULL);
INSERT INTO `yh_regions` VALUES (73, 130500, 130000, '邢台市', NULL);
INSERT INTO `yh_regions` VALUES (74, 130600, 130000, '保定市', NULL);
INSERT INTO `yh_regions` VALUES (75, 130700, 130000, '张家口市', NULL);
INSERT INTO `yh_regions` VALUES (76, 130800, 130000, '承德市', NULL);
INSERT INTO `yh_regions` VALUES (77, 130900, 130000, '沧州市', NULL);
INSERT INTO `yh_regions` VALUES (78, 131000, 130000, '廊坊市', NULL);
INSERT INTO `yh_regions` VALUES (79, 131100, 130000, '衡水市', NULL);
INSERT INTO `yh_regions` VALUES (80, 130102, 130100, '长安区', NULL);
INSERT INTO `yh_regions` VALUES (81, 130104, 130100, '桥西区', NULL);
INSERT INTO `yh_regions` VALUES (82, 130105, 130100, '新华区', NULL);
INSERT INTO `yh_regions` VALUES (83, 130107, 130100, '井陉矿区', NULL);
INSERT INTO `yh_regions` VALUES (84, 130108, 130100, '裕华区', NULL);
INSERT INTO `yh_regions` VALUES (85, 130109, 130100, '藁城区', NULL);
INSERT INTO `yh_regions` VALUES (86, 130110, 130100, '鹿泉区', NULL);
INSERT INTO `yh_regions` VALUES (87, 130111, 130100, '栾城区', NULL);
INSERT INTO `yh_regions` VALUES (88, 130121, 130100, '井陉县', NULL);
INSERT INTO `yh_regions` VALUES (89, 130123, 130100, '正定县', NULL);
INSERT INTO `yh_regions` VALUES (90, 130125, 130100, '行唐县', NULL);
INSERT INTO `yh_regions` VALUES (91, 130126, 130100, '灵寿县', NULL);
INSERT INTO `yh_regions` VALUES (92, 130127, 130100, '高邑县', NULL);
INSERT INTO `yh_regions` VALUES (93, 130128, 130100, '深泽县', NULL);
INSERT INTO `yh_regions` VALUES (94, 130129, 130100, '赞皇县', NULL);
INSERT INTO `yh_regions` VALUES (95, 130130, 130100, '无极县', NULL);
INSERT INTO `yh_regions` VALUES (96, 130131, 130100, '平山县', NULL);
INSERT INTO `yh_regions` VALUES (97, 130132, 130100, '元氏县', NULL);
INSERT INTO `yh_regions` VALUES (98, 130133, 130100, '赵县', NULL);
INSERT INTO `yh_regions` VALUES (99, 130181, 130100, '辛集市', NULL);
INSERT INTO `yh_regions` VALUES (100, 130183, 130100, '晋州市', NULL);
INSERT INTO `yh_regions` VALUES (101, 130184, 130100, '新乐市', NULL);
INSERT INTO `yh_regions` VALUES (102, 130202, 130200, '路南区', NULL);
INSERT INTO `yh_regions` VALUES (103, 130203, 130200, '路北区', NULL);
INSERT INTO `yh_regions` VALUES (104, 130204, 130200, '古冶区', NULL);
INSERT INTO `yh_regions` VALUES (105, 130205, 130200, '开平区', NULL);
INSERT INTO `yh_regions` VALUES (106, 130207, 130200, '丰南区', NULL);
INSERT INTO `yh_regions` VALUES (107, 130208, 130200, '丰润区', NULL);
INSERT INTO `yh_regions` VALUES (108, 130209, 130200, '曹妃甸区', NULL);
INSERT INTO `yh_regions` VALUES (109, 130223, 130200, '滦县', NULL);
INSERT INTO `yh_regions` VALUES (110, 130224, 130200, '滦南县', NULL);
INSERT INTO `yh_regions` VALUES (111, 130225, 130200, '乐亭县', NULL);
INSERT INTO `yh_regions` VALUES (112, 130227, 130200, '迁西县', NULL);
INSERT INTO `yh_regions` VALUES (113, 130229, 130200, '玉田县', NULL);
INSERT INTO `yh_regions` VALUES (114, 130281, 130200, '遵化市', NULL);
INSERT INTO `yh_regions` VALUES (115, 130283, 130200, '迁安市', NULL);
INSERT INTO `yh_regions` VALUES (116, 130302, 130300, '海港区', NULL);
INSERT INTO `yh_regions` VALUES (117, 130303, 130300, '山海关区', NULL);
INSERT INTO `yh_regions` VALUES (118, 130304, 130300, '北戴河区', NULL);
INSERT INTO `yh_regions` VALUES (119, 130306, 130300, '抚宁区', NULL);
INSERT INTO `yh_regions` VALUES (120, 130321, 130300, '青龙满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (121, 130322, 130300, '昌黎县', NULL);
INSERT INTO `yh_regions` VALUES (122, 130324, 130300, '卢龙县', NULL);
INSERT INTO `yh_regions` VALUES (123, 130402, 130400, '邯山区', NULL);
INSERT INTO `yh_regions` VALUES (124, 130403, 130400, '丛台区', NULL);
INSERT INTO `yh_regions` VALUES (125, 130404, 130400, '复兴区', NULL);
INSERT INTO `yh_regions` VALUES (126, 130406, 130400, '峰峰矿区', NULL);
INSERT INTO `yh_regions` VALUES (127, 130407, 130400, '肥乡区', NULL);
INSERT INTO `yh_regions` VALUES (128, 130408, 130400, '永年区', NULL);
INSERT INTO `yh_regions` VALUES (129, 130423, 130400, '临漳县', NULL);
INSERT INTO `yh_regions` VALUES (130, 130424, 130400, '成安县', NULL);
INSERT INTO `yh_regions` VALUES (131, 130425, 130400, '大名县', NULL);
INSERT INTO `yh_regions` VALUES (132, 130426, 130400, '涉县', NULL);
INSERT INTO `yh_regions` VALUES (133, 130427, 130400, '磁县', NULL);
INSERT INTO `yh_regions` VALUES (134, 130430, 130400, '邱县', NULL);
INSERT INTO `yh_regions` VALUES (135, 130431, 130400, '鸡泽县', NULL);
INSERT INTO `yh_regions` VALUES (136, 130432, 130400, '广平县', NULL);
INSERT INTO `yh_regions` VALUES (137, 130433, 130400, '馆陶县', NULL);
INSERT INTO `yh_regions` VALUES (138, 130434, 130400, '魏县', NULL);
INSERT INTO `yh_regions` VALUES (139, 130435, 130400, '曲周县', NULL);
INSERT INTO `yh_regions` VALUES (140, 130481, 130400, '武安市', NULL);
INSERT INTO `yh_regions` VALUES (141, 130502, 130500, '桥东区', NULL);
INSERT INTO `yh_regions` VALUES (142, 130503, 130500, '桥西区', NULL);
INSERT INTO `yh_regions` VALUES (143, 130521, 130500, '邢台县', NULL);
INSERT INTO `yh_regions` VALUES (144, 130522, 130500, '临城县', NULL);
INSERT INTO `yh_regions` VALUES (145, 130523, 130500, '内丘县', NULL);
INSERT INTO `yh_regions` VALUES (146, 130524, 130500, '柏乡县', NULL);
INSERT INTO `yh_regions` VALUES (147, 130525, 130500, '隆尧县', NULL);
INSERT INTO `yh_regions` VALUES (148, 130526, 130500, '任县', NULL);
INSERT INTO `yh_regions` VALUES (149, 130527, 130500, '南和县', NULL);
INSERT INTO `yh_regions` VALUES (150, 130528, 130500, '宁晋县', NULL);
INSERT INTO `yh_regions` VALUES (151, 130529, 130500, '巨鹿县', NULL);
INSERT INTO `yh_regions` VALUES (152, 130530, 130500, '新河县', NULL);
INSERT INTO `yh_regions` VALUES (153, 130531, 130500, '广宗县', NULL);
INSERT INTO `yh_regions` VALUES (154, 130532, 130500, '平乡县', NULL);
INSERT INTO `yh_regions` VALUES (155, 130533, 130500, '威县', NULL);
INSERT INTO `yh_regions` VALUES (156, 130534, 130500, '清河县', NULL);
INSERT INTO `yh_regions` VALUES (157, 130535, 130500, '临西县', NULL);
INSERT INTO `yh_regions` VALUES (158, 130581, 130500, '南宫市', NULL);
INSERT INTO `yh_regions` VALUES (159, 130582, 130500, '沙河市', NULL);
INSERT INTO `yh_regions` VALUES (160, 130602, 130600, '竞秀区', NULL);
INSERT INTO `yh_regions` VALUES (161, 130606, 130600, '莲池区', NULL);
INSERT INTO `yh_regions` VALUES (162, 130607, 130600, '满城区', NULL);
INSERT INTO `yh_regions` VALUES (163, 130608, 130600, '清苑区', NULL);
INSERT INTO `yh_regions` VALUES (164, 130609, 130600, '徐水区', NULL);
INSERT INTO `yh_regions` VALUES (165, 130623, 130600, '涞水县', NULL);
INSERT INTO `yh_regions` VALUES (166, 130624, 130600, '阜平县', NULL);
INSERT INTO `yh_regions` VALUES (167, 130626, 130600, '定兴县', NULL);
INSERT INTO `yh_regions` VALUES (168, 130627, 130600, '唐县', NULL);
INSERT INTO `yh_regions` VALUES (169, 130628, 130600, '高阳县', NULL);
INSERT INTO `yh_regions` VALUES (170, 130629, 130600, '容城县', NULL);
INSERT INTO `yh_regions` VALUES (171, 130630, 130600, '涞源县', NULL);
INSERT INTO `yh_regions` VALUES (172, 130631, 130600, '望都县', NULL);
INSERT INTO `yh_regions` VALUES (173, 130632, 130600, '安新县', NULL);
INSERT INTO `yh_regions` VALUES (174, 130633, 130600, '易县', NULL);
INSERT INTO `yh_regions` VALUES (175, 130634, 130600, '曲阳县', NULL);
INSERT INTO `yh_regions` VALUES (176, 130635, 130600, '蠡县', NULL);
INSERT INTO `yh_regions` VALUES (177, 130636, 130600, '顺平县', NULL);
INSERT INTO `yh_regions` VALUES (178, 130637, 130600, '博野县', NULL);
INSERT INTO `yh_regions` VALUES (179, 130638, 130600, '雄县', NULL);
INSERT INTO `yh_regions` VALUES (180, 130681, 130600, '涿州市', NULL);
INSERT INTO `yh_regions` VALUES (181, 130682, 130600, '定州市', NULL);
INSERT INTO `yh_regions` VALUES (182, 130683, 130600, '安国市', NULL);
INSERT INTO `yh_regions` VALUES (183, 130684, 130600, '高碑店市', NULL);
INSERT INTO `yh_regions` VALUES (184, 130702, 130700, '桥东区', NULL);
INSERT INTO `yh_regions` VALUES (185, 130703, 130700, '桥西区', NULL);
INSERT INTO `yh_regions` VALUES (186, 130705, 130700, '宣化区', NULL);
INSERT INTO `yh_regions` VALUES (187, 130706, 130700, '下花园区', NULL);
INSERT INTO `yh_regions` VALUES (188, 130708, 130700, '万全区', NULL);
INSERT INTO `yh_regions` VALUES (189, 130709, 130700, '崇礼区', NULL);
INSERT INTO `yh_regions` VALUES (190, 130722, 130700, '张北县', NULL);
INSERT INTO `yh_regions` VALUES (191, 130723, 130700, '康保县', NULL);
INSERT INTO `yh_regions` VALUES (192, 130724, 130700, '沽源县', NULL);
INSERT INTO `yh_regions` VALUES (193, 130725, 130700, '尚义县', NULL);
INSERT INTO `yh_regions` VALUES (194, 130726, 130700, '蔚县', NULL);
INSERT INTO `yh_regions` VALUES (195, 130727, 130700, '阳原县', NULL);
INSERT INTO `yh_regions` VALUES (196, 130728, 130700, '怀安县', NULL);
INSERT INTO `yh_regions` VALUES (197, 130730, 130700, '怀来县', NULL);
INSERT INTO `yh_regions` VALUES (198, 130731, 130700, '涿鹿县', NULL);
INSERT INTO `yh_regions` VALUES (199, 130732, 130700, '赤城县', NULL);
INSERT INTO `yh_regions` VALUES (200, 130802, 130800, '双桥区', NULL);
INSERT INTO `yh_regions` VALUES (201, 130803, 130800, '双滦区', NULL);
INSERT INTO `yh_regions` VALUES (202, 130804, 130800, '鹰手营子矿区', NULL);
INSERT INTO `yh_regions` VALUES (203, 130821, 130800, '承德县', NULL);
INSERT INTO `yh_regions` VALUES (204, 130822, 130800, '兴隆县', NULL);
INSERT INTO `yh_regions` VALUES (205, 130824, 130800, '滦平县', NULL);
INSERT INTO `yh_regions` VALUES (206, 130825, 130800, '隆化县', NULL);
INSERT INTO `yh_regions` VALUES (207, 130826, 130800, '丰宁满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (208, 130827, 130800, '宽城满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (209, 130828, 130800, '围场满族蒙古族自治县', NULL);
INSERT INTO `yh_regions` VALUES (210, 130881, 130800, '平泉市', NULL);
INSERT INTO `yh_regions` VALUES (211, 130902, 130900, '新华区', NULL);
INSERT INTO `yh_regions` VALUES (212, 130903, 130900, '运河区', NULL);
INSERT INTO `yh_regions` VALUES (213, 130921, 130900, '沧县', NULL);
INSERT INTO `yh_regions` VALUES (214, 130922, 130900, '青县', NULL);
INSERT INTO `yh_regions` VALUES (215, 130923, 130900, '东光县', NULL);
INSERT INTO `yh_regions` VALUES (216, 130924, 130900, '海兴县', NULL);
INSERT INTO `yh_regions` VALUES (217, 130925, 130900, '盐山县', NULL);
INSERT INTO `yh_regions` VALUES (218, 130926, 130900, '肃宁县', NULL);
INSERT INTO `yh_regions` VALUES (219, 130927, 130900, '南皮县', NULL);
INSERT INTO `yh_regions` VALUES (220, 130928, 130900, '吴桥县', NULL);
INSERT INTO `yh_regions` VALUES (221, 130929, 130900, '献县', NULL);
INSERT INTO `yh_regions` VALUES (222, 130930, 130900, '孟村回族自治县', NULL);
INSERT INTO `yh_regions` VALUES (223, 130981, 130900, '泊头市', NULL);
INSERT INTO `yh_regions` VALUES (224, 130982, 130900, '任丘市', NULL);
INSERT INTO `yh_regions` VALUES (225, 130983, 130900, '黄骅市', NULL);
INSERT INTO `yh_regions` VALUES (226, 130984, 130900, '河间市', NULL);
INSERT INTO `yh_regions` VALUES (227, 131002, 131000, '安次区', NULL);
INSERT INTO `yh_regions` VALUES (228, 131003, 131000, '广阳区', NULL);
INSERT INTO `yh_regions` VALUES (229, 131022, 131000, '固安县', NULL);
INSERT INTO `yh_regions` VALUES (230, 131023, 131000, '永清县', NULL);
INSERT INTO `yh_regions` VALUES (231, 131024, 131000, '香河县', NULL);
INSERT INTO `yh_regions` VALUES (232, 131025, 131000, '大城县', NULL);
INSERT INTO `yh_regions` VALUES (233, 131026, 131000, '文安县', NULL);
INSERT INTO `yh_regions` VALUES (234, 131028, 131000, '大厂回族自治县', NULL);
INSERT INTO `yh_regions` VALUES (235, 131081, 131000, '霸州市', NULL);
INSERT INTO `yh_regions` VALUES (236, 131082, 131000, '三河市', NULL);
INSERT INTO `yh_regions` VALUES (237, 131102, 131100, '桃城区', NULL);
INSERT INTO `yh_regions` VALUES (238, 131103, 131100, '冀州区', NULL);
INSERT INTO `yh_regions` VALUES (239, 131121, 131100, '枣强县', NULL);
INSERT INTO `yh_regions` VALUES (240, 131122, 131100, '武邑县', NULL);
INSERT INTO `yh_regions` VALUES (241, 131123, 131100, '武强县', NULL);
INSERT INTO `yh_regions` VALUES (242, 131124, 131100, '饶阳县', NULL);
INSERT INTO `yh_regions` VALUES (243, 131125, 131100, '安平县', NULL);
INSERT INTO `yh_regions` VALUES (244, 131126, 131100, '故城县', NULL);
INSERT INTO `yh_regions` VALUES (245, 131127, 131100, '景县', NULL);
INSERT INTO `yh_regions` VALUES (246, 131128, 131100, '阜城县', NULL);
INSERT INTO `yh_regions` VALUES (247, 131182, 131100, '深州市', NULL);
INSERT INTO `yh_regions` VALUES (248, 140100, 140000, '太原市', NULL);
INSERT INTO `yh_regions` VALUES (249, 140200, 140000, '大同市', NULL);
INSERT INTO `yh_regions` VALUES (250, 140300, 140000, '阳泉市', NULL);
INSERT INTO `yh_regions` VALUES (251, 140400, 140000, '长治市', NULL);
INSERT INTO `yh_regions` VALUES (252, 140500, 140000, '晋城市', NULL);
INSERT INTO `yh_regions` VALUES (253, 140600, 140000, '朔州市', NULL);
INSERT INTO `yh_regions` VALUES (254, 140700, 140000, '晋中市', NULL);
INSERT INTO `yh_regions` VALUES (255, 140800, 140000, '运城市', NULL);
INSERT INTO `yh_regions` VALUES (256, 140900, 140000, '忻州市', NULL);
INSERT INTO `yh_regions` VALUES (257, 141000, 140000, '临汾市', NULL);
INSERT INTO `yh_regions` VALUES (258, 141100, 140000, '吕梁市', NULL);
INSERT INTO `yh_regions` VALUES (259, 140105, 140100, '小店区', NULL);
INSERT INTO `yh_regions` VALUES (260, 140106, 140100, '迎泽区', NULL);
INSERT INTO `yh_regions` VALUES (261, 140107, 140100, '杏花岭区', NULL);
INSERT INTO `yh_regions` VALUES (262, 140108, 140100, '尖草坪区', NULL);
INSERT INTO `yh_regions` VALUES (263, 140109, 140100, '万柏林区', NULL);
INSERT INTO `yh_regions` VALUES (264, 140110, 140100, '晋源区', NULL);
INSERT INTO `yh_regions` VALUES (265, 140121, 140100, '清徐县', NULL);
INSERT INTO `yh_regions` VALUES (266, 140122, 140100, '阳曲县', NULL);
INSERT INTO `yh_regions` VALUES (267, 140123, 140100, '娄烦县', NULL);
INSERT INTO `yh_regions` VALUES (268, 140181, 140100, '古交市', NULL);
INSERT INTO `yh_regions` VALUES (269, 140202, 140200, '城区', NULL);
INSERT INTO `yh_regions` VALUES (270, 140203, 140200, '矿区', NULL);
INSERT INTO `yh_regions` VALUES (271, 140211, 140200, '南郊区', NULL);
INSERT INTO `yh_regions` VALUES (272, 140212, 140200, '新荣区', NULL);
INSERT INTO `yh_regions` VALUES (273, 140221, 140200, '阳高县', NULL);
INSERT INTO `yh_regions` VALUES (274, 140222, 140200, '天镇县', NULL);
INSERT INTO `yh_regions` VALUES (275, 140223, 140200, '广灵县', NULL);
INSERT INTO `yh_regions` VALUES (276, 140224, 140200, '灵丘县', NULL);
INSERT INTO `yh_regions` VALUES (277, 140225, 140200, '浑源县', NULL);
INSERT INTO `yh_regions` VALUES (278, 140226, 140200, '左云县', NULL);
INSERT INTO `yh_regions` VALUES (279, 140227, 140200, '大同县', NULL);
INSERT INTO `yh_regions` VALUES (280, 140302, 140300, '城区', NULL);
INSERT INTO `yh_regions` VALUES (281, 140303, 140300, '矿区', NULL);
INSERT INTO `yh_regions` VALUES (282, 140311, 140300, '郊区', NULL);
INSERT INTO `yh_regions` VALUES (283, 140321, 140300, '平定县', NULL);
INSERT INTO `yh_regions` VALUES (284, 140322, 140300, '盂县', NULL);
INSERT INTO `yh_regions` VALUES (285, 140402, 140400, '城区', NULL);
INSERT INTO `yh_regions` VALUES (286, 140411, 140400, '郊区', NULL);
INSERT INTO `yh_regions` VALUES (287, 140421, 140400, '长治县', NULL);
INSERT INTO `yh_regions` VALUES (288, 140423, 140400, '襄垣县', NULL);
INSERT INTO `yh_regions` VALUES (289, 140424, 140400, '屯留县', NULL);
INSERT INTO `yh_regions` VALUES (290, 140425, 140400, '平顺县', NULL);
INSERT INTO `yh_regions` VALUES (291, 140426, 140400, '黎城县', NULL);
INSERT INTO `yh_regions` VALUES (292, 140427, 140400, '壶关县', NULL);
INSERT INTO `yh_regions` VALUES (293, 140428, 140400, '长子县', NULL);
INSERT INTO `yh_regions` VALUES (294, 140429, 140400, '武乡县', NULL);
INSERT INTO `yh_regions` VALUES (295, 140430, 140400, '沁县', NULL);
INSERT INTO `yh_regions` VALUES (296, 140431, 140400, '沁源县', NULL);
INSERT INTO `yh_regions` VALUES (297, 140481, 140400, '潞城市', NULL);
INSERT INTO `yh_regions` VALUES (298, 140502, 140500, '城区', NULL);
INSERT INTO `yh_regions` VALUES (299, 140521, 140500, '沁水县', NULL);
INSERT INTO `yh_regions` VALUES (300, 140522, 140500, '阳城县', NULL);
INSERT INTO `yh_regions` VALUES (301, 140524, 140500, '陵川县', NULL);
INSERT INTO `yh_regions` VALUES (302, 140525, 140500, '泽州县', NULL);
INSERT INTO `yh_regions` VALUES (303, 140581, 140500, '高平市', NULL);
INSERT INTO `yh_regions` VALUES (304, 140602, 140600, '朔城区', NULL);
INSERT INTO `yh_regions` VALUES (305, 140603, 140600, '平鲁区', NULL);
INSERT INTO `yh_regions` VALUES (306, 140621, 140600, '山阴县', NULL);
INSERT INTO `yh_regions` VALUES (307, 140622, 140600, '应县', NULL);
INSERT INTO `yh_regions` VALUES (308, 140623, 140600, '右玉县', NULL);
INSERT INTO `yh_regions` VALUES (309, 140624, 140600, '怀仁县', NULL);
INSERT INTO `yh_regions` VALUES (310, 140702, 140700, '榆次区', NULL);
INSERT INTO `yh_regions` VALUES (311, 140721, 140700, '榆社县', NULL);
INSERT INTO `yh_regions` VALUES (312, 140722, 140700, '左权县', NULL);
INSERT INTO `yh_regions` VALUES (313, 140723, 140700, '和顺县', NULL);
INSERT INTO `yh_regions` VALUES (314, 140724, 140700, '昔阳县', NULL);
INSERT INTO `yh_regions` VALUES (315, 140725, 140700, '寿阳县', NULL);
INSERT INTO `yh_regions` VALUES (316, 140726, 140700, '太谷县', NULL);
INSERT INTO `yh_regions` VALUES (317, 140727, 140700, '祁县', NULL);
INSERT INTO `yh_regions` VALUES (318, 140728, 140700, '平遥县', NULL);
INSERT INTO `yh_regions` VALUES (319, 140729, 140700, '灵石县', NULL);
INSERT INTO `yh_regions` VALUES (320, 140781, 140700, '介休市', NULL);
INSERT INTO `yh_regions` VALUES (321, 140802, 140800, '盐湖区', NULL);
INSERT INTO `yh_regions` VALUES (322, 140821, 140800, '临猗县', NULL);
INSERT INTO `yh_regions` VALUES (323, 140822, 140800, '万荣县', NULL);
INSERT INTO `yh_regions` VALUES (324, 140823, 140800, '闻喜县', NULL);
INSERT INTO `yh_regions` VALUES (325, 140824, 140800, '稷山县', NULL);
INSERT INTO `yh_regions` VALUES (326, 140825, 140800, '新绛县', NULL);
INSERT INTO `yh_regions` VALUES (327, 140826, 140800, '绛县', NULL);
INSERT INTO `yh_regions` VALUES (328, 140827, 140800, '垣曲县', NULL);
INSERT INTO `yh_regions` VALUES (329, 140828, 140800, '夏县', NULL);
INSERT INTO `yh_regions` VALUES (330, 140829, 140800, '平陆县', NULL);
INSERT INTO `yh_regions` VALUES (331, 140830, 140800, '芮城县', NULL);
INSERT INTO `yh_regions` VALUES (332, 140881, 140800, '永济市', NULL);
INSERT INTO `yh_regions` VALUES (333, 140882, 140800, '河津市', NULL);
INSERT INTO `yh_regions` VALUES (334, 140902, 140900, '忻府区', NULL);
INSERT INTO `yh_regions` VALUES (335, 140921, 140900, '定襄县', NULL);
INSERT INTO `yh_regions` VALUES (336, 140922, 140900, '五台县', NULL);
INSERT INTO `yh_regions` VALUES (337, 140923, 140900, '代县', NULL);
INSERT INTO `yh_regions` VALUES (338, 140924, 140900, '繁峙县', NULL);
INSERT INTO `yh_regions` VALUES (339, 140925, 140900, '宁武县', NULL);
INSERT INTO `yh_regions` VALUES (340, 140926, 140900, '静乐县', NULL);
INSERT INTO `yh_regions` VALUES (341, 140927, 140900, '神池县', NULL);
INSERT INTO `yh_regions` VALUES (342, 140928, 140900, '五寨县', NULL);
INSERT INTO `yh_regions` VALUES (343, 140929, 140900, '岢岚县', NULL);
INSERT INTO `yh_regions` VALUES (344, 140930, 140900, '河曲县', NULL);
INSERT INTO `yh_regions` VALUES (345, 140931, 140900, '保德县', NULL);
INSERT INTO `yh_regions` VALUES (346, 140932, 140900, '偏关县', NULL);
INSERT INTO `yh_regions` VALUES (347, 140981, 140900, '原平市', NULL);
INSERT INTO `yh_regions` VALUES (348, 141002, 141000, '尧都区', NULL);
INSERT INTO `yh_regions` VALUES (349, 141021, 141000, '曲沃县', NULL);
INSERT INTO `yh_regions` VALUES (350, 141022, 141000, '翼城县', NULL);
INSERT INTO `yh_regions` VALUES (351, 141023, 141000, '襄汾县', NULL);
INSERT INTO `yh_regions` VALUES (352, 141024, 141000, '洪洞县', NULL);
INSERT INTO `yh_regions` VALUES (353, 141025, 141000, '古县', NULL);
INSERT INTO `yh_regions` VALUES (354, 141026, 141000, '安泽县', NULL);
INSERT INTO `yh_regions` VALUES (355, 141027, 141000, '浮山县', NULL);
INSERT INTO `yh_regions` VALUES (356, 141028, 141000, '吉县', NULL);
INSERT INTO `yh_regions` VALUES (357, 141029, 141000, '乡宁县', NULL);
INSERT INTO `yh_regions` VALUES (358, 141030, 141000, '大宁县', NULL);
INSERT INTO `yh_regions` VALUES (359, 141031, 141000, '隰县', NULL);
INSERT INTO `yh_regions` VALUES (360, 141032, 141000, '永和县', NULL);
INSERT INTO `yh_regions` VALUES (361, 141033, 141000, '蒲县', NULL);
INSERT INTO `yh_regions` VALUES (362, 141034, 141000, '汾西县', NULL);
INSERT INTO `yh_regions` VALUES (363, 141081, 141000, '侯马市', NULL);
INSERT INTO `yh_regions` VALUES (364, 141082, 141000, '霍州市', NULL);
INSERT INTO `yh_regions` VALUES (365, 141102, 141100, '离石区', NULL);
INSERT INTO `yh_regions` VALUES (366, 141121, 141100, '文水县', NULL);
INSERT INTO `yh_regions` VALUES (367, 141122, 141100, '交城县', NULL);
INSERT INTO `yh_regions` VALUES (368, 141123, 141100, '兴县', NULL);
INSERT INTO `yh_regions` VALUES (369, 141124, 141100, '临县', NULL);
INSERT INTO `yh_regions` VALUES (370, 141125, 141100, '柳林县', NULL);
INSERT INTO `yh_regions` VALUES (371, 141126, 141100, '石楼县', NULL);
INSERT INTO `yh_regions` VALUES (372, 141127, 141100, '岚县', NULL);
INSERT INTO `yh_regions` VALUES (373, 141128, 141100, '方山县', NULL);
INSERT INTO `yh_regions` VALUES (374, 141129, 141100, '中阳县', NULL);
INSERT INTO `yh_regions` VALUES (375, 141130, 141100, '交口县', NULL);
INSERT INTO `yh_regions` VALUES (376, 141181, 141100, '孝义市', NULL);
INSERT INTO `yh_regions` VALUES (377, 141182, 141100, '汾阳市', NULL);
INSERT INTO `yh_regions` VALUES (378, 150100, 150000, '呼和浩特市', NULL);
INSERT INTO `yh_regions` VALUES (379, 150200, 150000, '包头市', NULL);
INSERT INTO `yh_regions` VALUES (380, 150300, 150000, '乌海市', NULL);
INSERT INTO `yh_regions` VALUES (381, 150400, 150000, '赤峰市', NULL);
INSERT INTO `yh_regions` VALUES (382, 150500, 150000, '通辽市', NULL);
INSERT INTO `yh_regions` VALUES (383, 150600, 150000, '鄂尔多斯市', NULL);
INSERT INTO `yh_regions` VALUES (384, 150700, 150000, '呼伦贝尔市', NULL);
INSERT INTO `yh_regions` VALUES (385, 150800, 150000, '巴彦淖尔市', NULL);
INSERT INTO `yh_regions` VALUES (386, 150900, 150000, '乌兰察布市', NULL);
INSERT INTO `yh_regions` VALUES (387, 152200, 150000, '兴安盟', NULL);
INSERT INTO `yh_regions` VALUES (388, 152500, 150000, '锡林郭勒盟', NULL);
INSERT INTO `yh_regions` VALUES (389, 152900, 150000, '阿拉善盟', NULL);
INSERT INTO `yh_regions` VALUES (390, 150102, 150100, '新城区', NULL);
INSERT INTO `yh_regions` VALUES (391, 150103, 150100, '回民区', NULL);
INSERT INTO `yh_regions` VALUES (392, 150104, 150100, '玉泉区', NULL);
INSERT INTO `yh_regions` VALUES (393, 150105, 150100, '赛罕区', NULL);
INSERT INTO `yh_regions` VALUES (394, 150121, 150100, '土默特左旗', NULL);
INSERT INTO `yh_regions` VALUES (395, 150122, 150100, '托克托县', NULL);
INSERT INTO `yh_regions` VALUES (396, 150123, 150100, '和林格尔县', NULL);
INSERT INTO `yh_regions` VALUES (397, 150124, 150100, '清水河县', NULL);
INSERT INTO `yh_regions` VALUES (398, 150125, 150100, '武川县', NULL);
INSERT INTO `yh_regions` VALUES (399, 150202, 150200, '东河区', NULL);
INSERT INTO `yh_regions` VALUES (400, 150203, 150200, '昆都仑区', NULL);
INSERT INTO `yh_regions` VALUES (401, 150204, 150200, '青山区', NULL);
INSERT INTO `yh_regions` VALUES (402, 150205, 150200, '石拐区', NULL);
INSERT INTO `yh_regions` VALUES (403, 150206, 150200, '白云鄂博矿区', NULL);
INSERT INTO `yh_regions` VALUES (404, 150207, 150200, '九原区', NULL);
INSERT INTO `yh_regions` VALUES (405, 150221, 150200, '土默特右旗', NULL);
INSERT INTO `yh_regions` VALUES (406, 150222, 150200, '固阳县', NULL);
INSERT INTO `yh_regions` VALUES (407, 150223, 150200, '达尔罕茂明安联合旗', NULL);
INSERT INTO `yh_regions` VALUES (408, 150302, 150300, '海勃湾区', NULL);
INSERT INTO `yh_regions` VALUES (409, 150303, 150300, '海南区', NULL);
INSERT INTO `yh_regions` VALUES (410, 150304, 150300, '乌达区', NULL);
INSERT INTO `yh_regions` VALUES (411, 150402, 150400, '红山区', NULL);
INSERT INTO `yh_regions` VALUES (412, 150403, 150400, '元宝山区', NULL);
INSERT INTO `yh_regions` VALUES (413, 150404, 150400, '松山区', NULL);
INSERT INTO `yh_regions` VALUES (414, 150421, 150400, '阿鲁科尔沁旗', NULL);
INSERT INTO `yh_regions` VALUES (415, 150422, 150400, '巴林左旗', NULL);
INSERT INTO `yh_regions` VALUES (416, 150423, 150400, '巴林右旗', NULL);
INSERT INTO `yh_regions` VALUES (417, 150424, 150400, '林西县', NULL);
INSERT INTO `yh_regions` VALUES (418, 150425, 150400, '克什克腾旗', NULL);
INSERT INTO `yh_regions` VALUES (419, 150426, 150400, '翁牛特旗', NULL);
INSERT INTO `yh_regions` VALUES (420, 150428, 150400, '喀喇沁旗', NULL);
INSERT INTO `yh_regions` VALUES (421, 150429, 150400, '宁城县', NULL);
INSERT INTO `yh_regions` VALUES (422, 150430, 150400, '敖汉旗', NULL);
INSERT INTO `yh_regions` VALUES (423, 150502, 150500, '科尔沁区', NULL);
INSERT INTO `yh_regions` VALUES (424, 150521, 150500, '科尔沁左翼中旗', NULL);
INSERT INTO `yh_regions` VALUES (425, 150522, 150500, '科尔沁左翼后旗', NULL);
INSERT INTO `yh_regions` VALUES (426, 150523, 150500, '开鲁县', NULL);
INSERT INTO `yh_regions` VALUES (427, 150524, 150500, '库伦旗', NULL);
INSERT INTO `yh_regions` VALUES (428, 150525, 150500, '奈曼旗', NULL);
INSERT INTO `yh_regions` VALUES (429, 150526, 150500, '扎鲁特旗', NULL);
INSERT INTO `yh_regions` VALUES (430, 150581, 150500, '霍林郭勒市', NULL);
INSERT INTO `yh_regions` VALUES (431, 150602, 150600, '东胜区', NULL);
INSERT INTO `yh_regions` VALUES (432, 150603, 150600, '康巴什区', NULL);
INSERT INTO `yh_regions` VALUES (433, 150621, 150600, '达拉特旗', NULL);
INSERT INTO `yh_regions` VALUES (434, 150622, 150600, '准格尔旗', NULL);
INSERT INTO `yh_regions` VALUES (435, 150623, 150600, '鄂托克前旗', NULL);
INSERT INTO `yh_regions` VALUES (436, 150624, 150600, '鄂托克旗', NULL);
INSERT INTO `yh_regions` VALUES (437, 150625, 150600, '杭锦旗', NULL);
INSERT INTO `yh_regions` VALUES (438, 150626, 150600, '乌审旗', NULL);
INSERT INTO `yh_regions` VALUES (439, 150627, 150600, '伊金霍洛旗', NULL);
INSERT INTO `yh_regions` VALUES (440, 150702, 150700, '海拉尔区', NULL);
INSERT INTO `yh_regions` VALUES (441, 150703, 150700, '扎赉诺尔区', NULL);
INSERT INTO `yh_regions` VALUES (442, 150721, 150700, '阿荣旗', NULL);
INSERT INTO `yh_regions` VALUES (443, 150722, 150700, '莫力达瓦达斡尔族自治旗', NULL);
INSERT INTO `yh_regions` VALUES (444, 150723, 150700, '鄂伦春自治旗', NULL);
INSERT INTO `yh_regions` VALUES (445, 150724, 150700, '鄂温克族自治旗', NULL);
INSERT INTO `yh_regions` VALUES (446, 150725, 150700, '陈巴尔虎旗', NULL);
INSERT INTO `yh_regions` VALUES (447, 150726, 150700, '新巴尔虎左旗', NULL);
INSERT INTO `yh_regions` VALUES (448, 150727, 150700, '新巴尔虎右旗', NULL);
INSERT INTO `yh_regions` VALUES (449, 150781, 150700, '满洲里市', NULL);
INSERT INTO `yh_regions` VALUES (450, 150782, 150700, '牙克石市', NULL);
INSERT INTO `yh_regions` VALUES (451, 150783, 150700, '扎兰屯市', NULL);
INSERT INTO `yh_regions` VALUES (452, 150784, 150700, '额尔古纳市', NULL);
INSERT INTO `yh_regions` VALUES (453, 150785, 150700, '根河市', NULL);
INSERT INTO `yh_regions` VALUES (454, 150802, 150800, '临河区', NULL);
INSERT INTO `yh_regions` VALUES (455, 150821, 150800, '五原县', NULL);
INSERT INTO `yh_regions` VALUES (456, 150822, 150800, '磴口县', NULL);
INSERT INTO `yh_regions` VALUES (457, 150823, 150800, '乌拉特前旗', NULL);
INSERT INTO `yh_regions` VALUES (458, 150824, 150800, '乌拉特中旗', NULL);
INSERT INTO `yh_regions` VALUES (459, 150825, 150800, '乌拉特后旗', NULL);
INSERT INTO `yh_regions` VALUES (460, 150826, 150800, '杭锦后旗', NULL);
INSERT INTO `yh_regions` VALUES (461, 150902, 150900, '集宁区', NULL);
INSERT INTO `yh_regions` VALUES (462, 150921, 150900, '卓资县', NULL);
INSERT INTO `yh_regions` VALUES (463, 150922, 150900, '化德县', NULL);
INSERT INTO `yh_regions` VALUES (464, 150923, 150900, '商都县', NULL);
INSERT INTO `yh_regions` VALUES (465, 150924, 150900, '兴和县', NULL);
INSERT INTO `yh_regions` VALUES (466, 150925, 150900, '凉城县', NULL);
INSERT INTO `yh_regions` VALUES (467, 150926, 150900, '察哈尔右翼前旗', NULL);
INSERT INTO `yh_regions` VALUES (468, 150927, 150900, '察哈尔右翼中旗', NULL);
INSERT INTO `yh_regions` VALUES (469, 150928, 150900, '察哈尔右翼后旗', NULL);
INSERT INTO `yh_regions` VALUES (470, 150929, 150900, '四子王旗', NULL);
INSERT INTO `yh_regions` VALUES (471, 150981, 150900, '丰镇市', NULL);
INSERT INTO `yh_regions` VALUES (472, 152201, 152200, '乌兰浩特市', NULL);
INSERT INTO `yh_regions` VALUES (473, 152202, 152200, '阿尔山市', NULL);
INSERT INTO `yh_regions` VALUES (474, 152221, 152200, '科尔沁右翼前旗', NULL);
INSERT INTO `yh_regions` VALUES (475, 152222, 152200, '科尔沁右翼中旗', NULL);
INSERT INTO `yh_regions` VALUES (476, 152223, 152200, '扎赉特旗', NULL);
INSERT INTO `yh_regions` VALUES (477, 152224, 152200, '突泉县', NULL);
INSERT INTO `yh_regions` VALUES (478, 152501, 152500, '二连浩特市', NULL);
INSERT INTO `yh_regions` VALUES (479, 152502, 152500, '锡林浩特市', NULL);
INSERT INTO `yh_regions` VALUES (480, 152522, 152500, '阿巴嘎旗', NULL);
INSERT INTO `yh_regions` VALUES (481, 152523, 152500, '苏尼特左旗', NULL);
INSERT INTO `yh_regions` VALUES (482, 152524, 152500, '苏尼特右旗', NULL);
INSERT INTO `yh_regions` VALUES (483, 152525, 152500, '东乌珠穆沁旗', NULL);
INSERT INTO `yh_regions` VALUES (484, 152526, 152500, '西乌珠穆沁旗', NULL);
INSERT INTO `yh_regions` VALUES (485, 152527, 152500, '太仆寺旗', NULL);
INSERT INTO `yh_regions` VALUES (486, 152528, 152500, '镶黄旗', NULL);
INSERT INTO `yh_regions` VALUES (487, 152529, 152500, '正镶白旗', NULL);
INSERT INTO `yh_regions` VALUES (488, 152530, 152500, '正蓝旗', NULL);
INSERT INTO `yh_regions` VALUES (489, 152531, 152500, '多伦县', NULL);
INSERT INTO `yh_regions` VALUES (490, 152921, 152900, '阿拉善左旗', NULL);
INSERT INTO `yh_regions` VALUES (491, 152922, 152900, '阿拉善右旗', NULL);
INSERT INTO `yh_regions` VALUES (492, 152923, 152900, '额济纳旗', NULL);
INSERT INTO `yh_regions` VALUES (493, 210100, 210000, '沈阳市', NULL);
INSERT INTO `yh_regions` VALUES (494, 210200, 210000, '大连市', NULL);
INSERT INTO `yh_regions` VALUES (495, 210300, 210000, '鞍山市', NULL);
INSERT INTO `yh_regions` VALUES (496, 210400, 210000, '抚顺市', NULL);
INSERT INTO `yh_regions` VALUES (497, 210500, 210000, '本溪市', NULL);
INSERT INTO `yh_regions` VALUES (498, 210600, 210000, '丹东市', NULL);
INSERT INTO `yh_regions` VALUES (499, 210700, 210000, '锦州市', NULL);
INSERT INTO `yh_regions` VALUES (500, 210800, 210000, '营口市', NULL);
INSERT INTO `yh_regions` VALUES (501, 210900, 210000, '阜新市', NULL);
INSERT INTO `yh_regions` VALUES (502, 211000, 210000, '辽阳市', NULL);
INSERT INTO `yh_regions` VALUES (503, 211100, 210000, '盘锦市', NULL);
INSERT INTO `yh_regions` VALUES (504, 211200, 210000, '铁岭市', NULL);
INSERT INTO `yh_regions` VALUES (505, 211300, 210000, '朝阳市', NULL);
INSERT INTO `yh_regions` VALUES (506, 211400, 210000, '葫芦岛市', NULL);
INSERT INTO `yh_regions` VALUES (507, 210102, 210100, '和平区', NULL);
INSERT INTO `yh_regions` VALUES (508, 210103, 210100, '沈河区', NULL);
INSERT INTO `yh_regions` VALUES (509, 210104, 210100, '大东区', NULL);
INSERT INTO `yh_regions` VALUES (510, 210105, 210100, '皇姑区', NULL);
INSERT INTO `yh_regions` VALUES (511, 210106, 210100, '铁西区', NULL);
INSERT INTO `yh_regions` VALUES (512, 210111, 210100, '苏家屯区', NULL);
INSERT INTO `yh_regions` VALUES (513, 210112, 210100, '浑南区', NULL);
INSERT INTO `yh_regions` VALUES (514, 210113, 210100, '沈北新区', NULL);
INSERT INTO `yh_regions` VALUES (515, 210114, 210100, '于洪区', NULL);
INSERT INTO `yh_regions` VALUES (516, 210115, 210100, '辽中区', NULL);
INSERT INTO `yh_regions` VALUES (517, 210123, 210100, '康平县', NULL);
INSERT INTO `yh_regions` VALUES (518, 210124, 210100, '法库县', NULL);
INSERT INTO `yh_regions` VALUES (519, 210181, 210100, '新民市', NULL);
INSERT INTO `yh_regions` VALUES (520, 210202, 210200, '中山区', NULL);
INSERT INTO `yh_regions` VALUES (521, 210203, 210200, '西岗区', NULL);
INSERT INTO `yh_regions` VALUES (522, 210204, 210200, '沙河口区', NULL);
INSERT INTO `yh_regions` VALUES (523, 210211, 210200, '甘井子区', NULL);
INSERT INTO `yh_regions` VALUES (524, 210212, 210200, '旅顺口区', NULL);
INSERT INTO `yh_regions` VALUES (525, 210213, 210200, '金州区', NULL);
INSERT INTO `yh_regions` VALUES (526, 210214, 210200, '普兰店区', NULL);
INSERT INTO `yh_regions` VALUES (527, 210224, 210200, '长海县', NULL);
INSERT INTO `yh_regions` VALUES (528, 210281, 210200, '瓦房店市', NULL);
INSERT INTO `yh_regions` VALUES (529, 210283, 210200, '庄河市', NULL);
INSERT INTO `yh_regions` VALUES (530, 210302, 210300, '铁东区', NULL);
INSERT INTO `yh_regions` VALUES (531, 210303, 210300, '铁西区', NULL);
INSERT INTO `yh_regions` VALUES (532, 210304, 210300, '立山区', NULL);
INSERT INTO `yh_regions` VALUES (533, 210311, 210300, '千山区', NULL);
INSERT INTO `yh_regions` VALUES (534, 210321, 210300, '台安县', NULL);
INSERT INTO `yh_regions` VALUES (535, 210323, 210300, '岫岩满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (536, 210381, 210300, '海城市', NULL);
INSERT INTO `yh_regions` VALUES (537, 210402, 210400, '新抚区', NULL);
INSERT INTO `yh_regions` VALUES (538, 210403, 210400, '东洲区', NULL);
INSERT INTO `yh_regions` VALUES (539, 210404, 210400, '望花区', NULL);
INSERT INTO `yh_regions` VALUES (540, 210411, 210400, '顺城区', NULL);
INSERT INTO `yh_regions` VALUES (541, 210421, 210400, '抚顺县', NULL);
INSERT INTO `yh_regions` VALUES (542, 210422, 210400, '新宾满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (543, 210423, 210400, '清原满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (544, 210502, 210500, '平山区', NULL);
INSERT INTO `yh_regions` VALUES (545, 210503, 210500, '溪湖区', NULL);
INSERT INTO `yh_regions` VALUES (546, 210504, 210500, '明山区', NULL);
INSERT INTO `yh_regions` VALUES (547, 210505, 210500, '南芬区', NULL);
INSERT INTO `yh_regions` VALUES (548, 210521, 210500, '本溪满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (549, 210522, 210500, '桓仁满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (550, 210602, 210600, '元宝区', NULL);
INSERT INTO `yh_regions` VALUES (551, 210603, 210600, '振兴区', NULL);
INSERT INTO `yh_regions` VALUES (552, 210604, 210600, '振安区', NULL);
INSERT INTO `yh_regions` VALUES (553, 210624, 210600, '宽甸满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (554, 210681, 210600, '东港市', NULL);
INSERT INTO `yh_regions` VALUES (555, 210682, 210600, '凤城市', NULL);
INSERT INTO `yh_regions` VALUES (556, 210702, 210700, '古塔区', NULL);
INSERT INTO `yh_regions` VALUES (557, 210703, 210700, '凌河区', NULL);
INSERT INTO `yh_regions` VALUES (558, 210711, 210700, '太和区', NULL);
INSERT INTO `yh_regions` VALUES (559, 210726, 210700, '黑山县', NULL);
INSERT INTO `yh_regions` VALUES (560, 210727, 210700, '义县', NULL);
INSERT INTO `yh_regions` VALUES (561, 210781, 210700, '凌海市', NULL);
INSERT INTO `yh_regions` VALUES (562, 210782, 210700, '北镇市', NULL);
INSERT INTO `yh_regions` VALUES (563, 210802, 210800, '站前区', NULL);
INSERT INTO `yh_regions` VALUES (564, 210803, 210800, '西市区', NULL);
INSERT INTO `yh_regions` VALUES (565, 210804, 210800, '鲅鱼圈区', NULL);
INSERT INTO `yh_regions` VALUES (566, 210811, 210800, '老边区', NULL);
INSERT INTO `yh_regions` VALUES (567, 210881, 210800, '盖州市', NULL);
INSERT INTO `yh_regions` VALUES (568, 210882, 210800, '大石桥市', NULL);
INSERT INTO `yh_regions` VALUES (569, 210902, 210900, '海州区', NULL);
INSERT INTO `yh_regions` VALUES (570, 210903, 210900, '新邱区', NULL);
INSERT INTO `yh_regions` VALUES (571, 210904, 210900, '太平区', NULL);
INSERT INTO `yh_regions` VALUES (572, 210905, 210900, '清河门区', NULL);
INSERT INTO `yh_regions` VALUES (573, 210911, 210900, '细河区', NULL);
INSERT INTO `yh_regions` VALUES (574, 210921, 210900, '阜新蒙古族自治县', NULL);
INSERT INTO `yh_regions` VALUES (575, 210922, 210900, '彰武县', NULL);
INSERT INTO `yh_regions` VALUES (576, 211002, 211000, '白塔区', NULL);
INSERT INTO `yh_regions` VALUES (577, 211003, 211000, '文圣区', NULL);
INSERT INTO `yh_regions` VALUES (578, 211004, 211000, '宏伟区', NULL);
INSERT INTO `yh_regions` VALUES (579, 211005, 211000, '弓长岭区', NULL);
INSERT INTO `yh_regions` VALUES (580, 211011, 211000, '太子河区', NULL);
INSERT INTO `yh_regions` VALUES (581, 211021, 211000, '辽阳县', NULL);
INSERT INTO `yh_regions` VALUES (582, 211081, 211000, '灯塔市', NULL);
INSERT INTO `yh_regions` VALUES (583, 211102, 211100, '双台子区', NULL);
INSERT INTO `yh_regions` VALUES (584, 211103, 211100, '兴隆台区', NULL);
INSERT INTO `yh_regions` VALUES (585, 211104, 211100, '大洼区', NULL);
INSERT INTO `yh_regions` VALUES (586, 211122, 211100, '盘山县', NULL);
INSERT INTO `yh_regions` VALUES (587, 211202, 211200, '银州区', NULL);
INSERT INTO `yh_regions` VALUES (588, 211204, 211200, '清河区', NULL);
INSERT INTO `yh_regions` VALUES (589, 211221, 211200, '铁岭县', NULL);
INSERT INTO `yh_regions` VALUES (590, 211223, 211200, '西丰县', NULL);
INSERT INTO `yh_regions` VALUES (591, 211224, 211200, '昌图县', NULL);
INSERT INTO `yh_regions` VALUES (592, 211281, 211200, '调兵山市', NULL);
INSERT INTO `yh_regions` VALUES (593, 211282, 211200, '开原市', NULL);
INSERT INTO `yh_regions` VALUES (594, 211302, 211300, '双塔区', NULL);
INSERT INTO `yh_regions` VALUES (595, 211303, 211300, '龙城区', NULL);
INSERT INTO `yh_regions` VALUES (596, 211321, 211300, '朝阳县', NULL);
INSERT INTO `yh_regions` VALUES (597, 211322, 211300, '建平县', NULL);
INSERT INTO `yh_regions` VALUES (598, 211324, 211300, '喀喇沁左翼蒙古族自治县', NULL);
INSERT INTO `yh_regions` VALUES (599, 211381, 211300, '北票市', NULL);
INSERT INTO `yh_regions` VALUES (600, 211382, 211300, '凌源市', NULL);
INSERT INTO `yh_regions` VALUES (601, 211402, 211400, '连山区', NULL);
INSERT INTO `yh_regions` VALUES (602, 211403, 211400, '龙港区', NULL);
INSERT INTO `yh_regions` VALUES (603, 211404, 211400, '南票区', NULL);
INSERT INTO `yh_regions` VALUES (604, 211421, 211400, '绥中县', NULL);
INSERT INTO `yh_regions` VALUES (605, 211422, 211400, '建昌县', NULL);
INSERT INTO `yh_regions` VALUES (606, 211481, 211400, '兴城市', NULL);
INSERT INTO `yh_regions` VALUES (607, 220100, 220000, '长春市', NULL);
INSERT INTO `yh_regions` VALUES (608, 220200, 220000, '吉林市', NULL);
INSERT INTO `yh_regions` VALUES (609, 220300, 220000, '四平市', NULL);
INSERT INTO `yh_regions` VALUES (610, 220400, 220000, '辽源市', NULL);
INSERT INTO `yh_regions` VALUES (611, 220500, 220000, '通化市', NULL);
INSERT INTO `yh_regions` VALUES (612, 220600, 220000, '白山市', NULL);
INSERT INTO `yh_regions` VALUES (613, 220700, 220000, '松原市', NULL);
INSERT INTO `yh_regions` VALUES (614, 220800, 220000, '白城市', NULL);
INSERT INTO `yh_regions` VALUES (615, 222400, 220000, '延边朝鲜族自治州', NULL);
INSERT INTO `yh_regions` VALUES (616, 220102, 220100, '南关区', NULL);
INSERT INTO `yh_regions` VALUES (617, 220103, 220100, '宽城区', NULL);
INSERT INTO `yh_regions` VALUES (618, 220104, 220100, '朝阳区', NULL);
INSERT INTO `yh_regions` VALUES (619, 220105, 220100, '二道区', NULL);
INSERT INTO `yh_regions` VALUES (620, 220106, 220100, '绿园区', NULL);
INSERT INTO `yh_regions` VALUES (621, 220112, 220100, '双阳区', NULL);
INSERT INTO `yh_regions` VALUES (622, 220113, 220100, '九台区', NULL);
INSERT INTO `yh_regions` VALUES (623, 220122, 220100, '农安县', NULL);
INSERT INTO `yh_regions` VALUES (624, 220182, 220100, '榆树市', NULL);
INSERT INTO `yh_regions` VALUES (625, 220183, 220100, '德惠市', NULL);
INSERT INTO `yh_regions` VALUES (626, 220202, 220200, '昌邑区', NULL);
INSERT INTO `yh_regions` VALUES (627, 220203, 220200, '龙潭区', NULL);
INSERT INTO `yh_regions` VALUES (628, 220204, 220200, '船营区', NULL);
INSERT INTO `yh_regions` VALUES (629, 220211, 220200, '丰满区', NULL);
INSERT INTO `yh_regions` VALUES (630, 220221, 220200, '永吉县', NULL);
INSERT INTO `yh_regions` VALUES (631, 220281, 220200, '蛟河市', NULL);
INSERT INTO `yh_regions` VALUES (632, 220282, 220200, '桦甸市', NULL);
INSERT INTO `yh_regions` VALUES (633, 220283, 220200, '舒兰市', NULL);
INSERT INTO `yh_regions` VALUES (634, 220284, 220200, '磐石市', NULL);
INSERT INTO `yh_regions` VALUES (635, 220302, 220300, '铁西区', NULL);
INSERT INTO `yh_regions` VALUES (636, 220303, 220300, '铁东区', NULL);
INSERT INTO `yh_regions` VALUES (637, 220322, 220300, '梨树县', NULL);
INSERT INTO `yh_regions` VALUES (638, 220323, 220300, '伊通满族自治县', NULL);
INSERT INTO `yh_regions` VALUES (639, 220381, 220300, '公主岭市', NULL);
INSERT INTO `yh_regions` VALUES (640, 220382, 220300, '双辽市', NULL);
INSERT INTO `yh_regions` VALUES (641, 220402, 220400, '龙山区', NULL);
INSERT INTO `yh_regions` VALUES (642, 220403, 220400, '西安区', NULL);
INSERT INTO `yh_regions` VALUES (643, 220421, 220400, '东丰县', NULL);
INSERT INTO `yh_regions` VALUES (644, 220422, 220400, '东辽县', NULL);
INSERT INTO `yh_regions` VALUES (645, 220502, 220500, '东昌区', NULL);
INSERT INTO `yh_regions` VALUES (646, 220503, 220500, '二道江区', NULL);
INSERT INTO `yh_regions` VALUES (647, 220521, 220500, '通化县', NULL);
INSERT INTO `yh_regions` VALUES (648, 220523, 220500, '辉南县', NULL);
INSERT INTO `yh_regions` VALUES (649, 220524, 220500, '柳河县', NULL);
INSERT INTO `yh_regions` VALUES (650, 220581, 220500, '梅河口市', NULL);
INSERT INTO `yh_regions` VALUES (651, 220582, 220500, '集安市', NULL);
INSERT INTO `yh_regions` VALUES (652, 220602, 220600, '浑江区', NULL);
INSERT INTO `yh_regions` VALUES (653, 220605, 220600, '江源区', NULL);
INSERT INTO `yh_regions` VALUES (654, 220621, 220600, '抚松县', NULL);
INSERT INTO `yh_regions` VALUES (655, 220622, 220600, '靖宇县', NULL);
INSERT INTO `yh_regions` VALUES (656, 220623, 220600, '长白朝鲜族自治县', NULL);
INSERT INTO `yh_regions` VALUES (657, 220681, 220600, '临江市', NULL);
INSERT INTO `yh_regions` VALUES (658, 220702, 220700, '宁江区', NULL);
INSERT INTO `yh_regions` VALUES (659, 220721, 220700, '前郭尔罗斯蒙古族自治县', NULL);
INSERT INTO `yh_regions` VALUES (660, 220722, 220700, '长岭县', NULL);
INSERT INTO `yh_regions` VALUES (661, 220723, 220700, '乾安县', NULL);
INSERT INTO `yh_regions` VALUES (662, 220781, 220700, '扶余市', NULL);
INSERT INTO `yh_regions` VALUES (663, 220802, 220800, '洮北区', NULL);
INSERT INTO `yh_regions` VALUES (664, 220821, 220800, '镇赉县', NULL);
INSERT INTO `yh_regions` VALUES (665, 220822, 220800, '通榆县', NULL);
INSERT INTO `yh_regions` VALUES (666, 220881, 220800, '洮南市', NULL);
INSERT INTO `yh_regions` VALUES (667, 220882, 220800, '大安市', NULL);
INSERT INTO `yh_regions` VALUES (668, 222401, 222400, '延吉市', NULL);
INSERT INTO `yh_regions` VALUES (669, 222402, 222400, '图们市', NULL);
INSERT INTO `yh_regions` VALUES (670, 222403, 222400, '敦化市', NULL);
INSERT INTO `yh_regions` VALUES (671, 222404, 222400, '珲春市', NULL);
INSERT INTO `yh_regions` VALUES (672, 222405, 222400, '龙井市', NULL);
INSERT INTO `yh_regions` VALUES (673, 222406, 222400, '和龙市', NULL);
INSERT INTO `yh_regions` VALUES (674, 222424, 222400, '汪清县', NULL);
INSERT INTO `yh_regions` VALUES (675, 222426, 222400, '安图县', NULL);
INSERT INTO `yh_regions` VALUES (676, 230100, 230000, '哈尔滨市', NULL);
INSERT INTO `yh_regions` VALUES (677, 230200, 230000, '齐齐哈尔市', NULL);
INSERT INTO `yh_regions` VALUES (678, 230300, 230000, '鸡西市', NULL);
INSERT INTO `yh_regions` VALUES (679, 230400, 230000, '鹤岗市', NULL);
INSERT INTO `yh_regions` VALUES (680, 230500, 230000, '双鸭山市', NULL);
INSERT INTO `yh_regions` VALUES (681, 230600, 230000, '大庆市', NULL);
INSERT INTO `yh_regions` VALUES (682, 230700, 230000, '伊春市', NULL);
INSERT INTO `yh_regions` VALUES (683, 230800, 230000, '佳木斯市', NULL);
INSERT INTO `yh_regions` VALUES (684, 230900, 230000, '七台河市', NULL);
INSERT INTO `yh_regions` VALUES (685, 231000, 230000, '牡丹江市', NULL);
INSERT INTO `yh_regions` VALUES (686, 231100, 230000, '黑河市', NULL);
INSERT INTO `yh_regions` VALUES (687, 231200, 230000, '绥化市', NULL);
INSERT INTO `yh_regions` VALUES (688, 232700, 230000, '大兴安岭地区', NULL);
INSERT INTO `yh_regions` VALUES (689, 230102, 230100, '道里区', NULL);
INSERT INTO `yh_regions` VALUES (690, 230103, 230100, '南岗区', NULL);
INSERT INTO `yh_regions` VALUES (691, 230104, 230100, '道外区', NULL);
INSERT INTO `yh_regions` VALUES (692, 230108, 230100, '平房区', NULL);
INSERT INTO `yh_regions` VALUES (693, 230109, 230100, '松北区', NULL);
INSERT INTO `yh_regions` VALUES (694, 230110, 230100, '香坊区', NULL);
INSERT INTO `yh_regions` VALUES (695, 230111, 230100, '呼兰区', NULL);
INSERT INTO `yh_regions` VALUES (696, 230112, 230100, '阿城区', NULL);
INSERT INTO `yh_regions` VALUES (697, 230113, 230100, '双城区', NULL);
INSERT INTO `yh_regions` VALUES (698, 230123, 230100, '依兰县', NULL);
INSERT INTO `yh_regions` VALUES (699, 230124, 230100, '方正县', NULL);
INSERT INTO `yh_regions` VALUES (700, 230125, 230100, '宾县', NULL);
INSERT INTO `yh_regions` VALUES (701, 230126, 230100, '巴彦县', NULL);
INSERT INTO `yh_regions` VALUES (702, 230127, 230100, '木兰县', NULL);
INSERT INTO `yh_regions` VALUES (703, 230128, 230100, '通河县', NULL);
INSERT INTO `yh_regions` VALUES (704, 230129, 230100, '延寿县', NULL);
INSERT INTO `yh_regions` VALUES (705, 230183, 230100, '尚志市', NULL);
INSERT INTO `yh_regions` VALUES (706, 230184, 230100, '五常市', NULL);
INSERT INTO `yh_regions` VALUES (707, 230202, 230200, '龙沙区', NULL);
INSERT INTO `yh_regions` VALUES (708, 230203, 230200, '建华区', NULL);
INSERT INTO `yh_regions` VALUES (709, 230204, 230200, '铁锋区', NULL);
INSERT INTO `yh_regions` VALUES (710, 230205, 230200, '昂昂溪区', NULL);
INSERT INTO `yh_regions` VALUES (711, 230206, 230200, '富拉尔基区', NULL);
INSERT INTO `yh_regions` VALUES (712, 230207, 230200, '碾子山区', NULL);
INSERT INTO `yh_regions` VALUES (713, 230208, 230200, '梅里斯达斡尔族区', NULL);
INSERT INTO `yh_regions` VALUES (714, 230221, 230200, '龙江县', NULL);
INSERT INTO `yh_regions` VALUES (715, 230223, 230200, '依安县', NULL);
INSERT INTO `yh_regions` VALUES (716, 230224, 230200, '泰来县', NULL);
INSERT INTO `yh_regions` VALUES (717, 230225, 230200, '甘南县', NULL);
INSERT INTO `yh_regions` VALUES (718, 230227, 230200, '富裕县', NULL);
INSERT INTO `yh_regions` VALUES (719, 230229, 230200, '克山县', NULL);
INSERT INTO `yh_regions` VALUES (720, 230230, 230200, '克东县', NULL);
INSERT INTO `yh_regions` VALUES (721, 230231, 230200, '拜泉县', NULL);
INSERT INTO `yh_regions` VALUES (722, 230281, 230200, '讷河市', NULL);
INSERT INTO `yh_regions` VALUES (723, 230302, 230300, '鸡冠区', NULL);
INSERT INTO `yh_regions` VALUES (724, 230303, 230300, '恒山区', NULL);
INSERT INTO `yh_regions` VALUES (725, 230304, 230300, '滴道区', NULL);
INSERT INTO `yh_regions` VALUES (726, 230305, 230300, '梨树区', NULL);
INSERT INTO `yh_regions` VALUES (727, 230306, 230300, '城子河区', NULL);
INSERT INTO `yh_regions` VALUES (728, 230307, 230300, '麻山区', NULL);
INSERT INTO `yh_regions` VALUES (729, 230321, 230300, '鸡东县', NULL);
INSERT INTO `yh_regions` VALUES (730, 230381, 230300, '虎林市', NULL);
INSERT INTO `yh_regions` VALUES (731, 230382, 230300, '密山市', NULL);
INSERT INTO `yh_regions` VALUES (732, 230402, 230400, '向阳区', NULL);
INSERT INTO `yh_regions` VALUES (733, 230403, 230400, '工农区', NULL);
INSERT INTO `yh_regions` VALUES (734, 230404, 230400, '南山区', NULL);
INSERT INTO `yh_regions` VALUES (735, 230405, 230400, '兴安区', NULL);
INSERT INTO `yh_regions` VALUES (736, 230406, 230400, '东山区', NULL);
INSERT INTO `yh_regions` VALUES (737, 230407, 230400, '兴山区', NULL);
INSERT INTO `yh_regions` VALUES (738, 230421, 230400, '萝北县', NULL);
INSERT INTO `yh_regions` VALUES (739, 230422, 230400, '绥滨县', NULL);
INSERT INTO `yh_regions` VALUES (740, 230502, 230500, '尖山区', NULL);
INSERT INTO `yh_regions` VALUES (741, 230503, 230500, '岭东区', NULL);
INSERT INTO `yh_regions` VALUES (742, 230505, 230500, '四方台区', NULL);
INSERT INTO `yh_regions` VALUES (743, 230506, 230500, '宝山区', NULL);
INSERT INTO `yh_regions` VALUES (744, 230521, 230500, '集贤县', NULL);
INSERT INTO `yh_regions` VALUES (745, 230522, 230500, '友谊县', NULL);
INSERT INTO `yh_regions` VALUES (746, 230523, 230500, '宝清县', NULL);
INSERT INTO `yh_regions` VALUES (747, 230524, 230500, '饶河县', NULL);
INSERT INTO `yh_regions` VALUES (748, 230602, 230600, '萨尔图区', NULL);
INSERT INTO `yh_regions` VALUES (749, 230603, 230600, '龙凤区', NULL);
INSERT INTO `yh_regions` VALUES (750, 230604, 230600, '让胡路区', NULL);
INSERT INTO `yh_regions` VALUES (751, 230605, 230600, '红岗区', NULL);
INSERT INTO `yh_regions` VALUES (752, 230606, 230600, '大同区', NULL);
INSERT INTO `yh_regions` VALUES (753, 230621, 230600, '肇州县', NULL);
INSERT INTO `yh_regions` VALUES (754, 230622, 230600, '肇源县', NULL);
INSERT INTO `yh_regions` VALUES (755, 230623, 230600, '林甸县', NULL);
INSERT INTO `yh_regions` VALUES (756, 230624, 230600, '杜尔伯特蒙古族自治县', NULL);
INSERT INTO `yh_regions` VALUES (757, 230702, 230700, '伊春区', NULL);
INSERT INTO `yh_regions` VALUES (758, 230703, 230700, '南岔区', NULL);
INSERT INTO `yh_regions` VALUES (759, 230704, 230700, '友好区', NULL);
INSERT INTO `yh_regions` VALUES (760, 230705, 230700, '西林区', NULL);
INSERT INTO `yh_regions` VALUES (761, 230706, 230700, '翠峦区', NULL);
INSERT INTO `yh_regions` VALUES (762, 230707, 230700, '新青区', NULL);
INSERT INTO `yh_regions` VALUES (763, 230708, 230700, '美溪区', NULL);
INSERT INTO `yh_regions` VALUES (764, 230709, 230700, '金山屯区', NULL);
INSERT INTO `yh_regions` VALUES (765, 230710, 230700, '五营区', NULL);
INSERT INTO `yh_regions` VALUES (766, 230711, 230700, '乌马河区', NULL);
INSERT INTO `yh_regions` VALUES (767, 230712, 230700, '汤旺河区', NULL);
INSERT INTO `yh_regions` VALUES (768, 230713, 230700, '带岭区', NULL);
INSERT INTO `yh_regions` VALUES (769, 230714, 230700, '乌伊岭区', NULL);
INSERT INTO `yh_regions` VALUES (770, 230715, 230700, '红星区', NULL);
INSERT INTO `yh_regions` VALUES (771, 230716, 230700, '上甘岭区', NULL);
INSERT INTO `yh_regions` VALUES (772, 230722, 230700, '嘉荫县', NULL);
INSERT INTO `yh_regions` VALUES (773, 230781, 230700, '铁力市', NULL);
INSERT INTO `yh_regions` VALUES (774, 230803, 230800, '向阳区', NULL);
INSERT INTO `yh_regions` VALUES (775, 230804, 230800, '前进区', NULL);
INSERT INTO `yh_regions` VALUES (776, 230805, 230800, '东风区', NULL);
INSERT INTO `yh_regions` VALUES (777, 230811, 230800, '郊区', NULL);
INSERT INTO `yh_regions` VALUES (778, 230822, 230800, '桦南县', NULL);
INSERT INTO `yh_regions` VALUES (779, 230826, 230800, '桦川县', NULL);
INSERT INTO `yh_regions` VALUES (780, 230828, 230800, '汤原县', NULL);
INSERT INTO `yh_regions` VALUES (781, 230881, 230800, '同江市', NULL);
INSERT INTO `yh_regions` VALUES (782, 230882, 230800, '富锦市', NULL);
INSERT INTO `yh_regions` VALUES (783, 230883, 230800, '抚远市', NULL);
INSERT INTO `yh_regions` VALUES (784, 230902, 230900, '新兴区', NULL);
INSERT INTO `yh_regions` VALUES (785, 230903, 230900, '桃山区', NULL);
INSERT INTO `yh_regions` VALUES (786, 230904, 230900, '茄子河区', NULL);
INSERT INTO `yh_regions` VALUES (787, 230921, 230900, '勃利县', NULL);
INSERT INTO `yh_regions` VALUES (788, 231002, 231000, '东安区', NULL);
INSERT INTO `yh_regions` VALUES (789, 231003, 231000, '阳明区', NULL);
INSERT INTO `yh_regions` VALUES (790, 231004, 231000, '爱民区', NULL);
INSERT INTO `yh_regions` VALUES (791, 231005, 231000, '西安区', NULL);
INSERT INTO `yh_regions` VALUES (792, 231025, 231000, '林口县', NULL);
INSERT INTO `yh_regions` VALUES (793, 231081, 231000, '绥芬河市', NULL);
INSERT INTO `yh_regions` VALUES (794, 231083, 231000, '海林市', NULL);
INSERT INTO `yh_regions` VALUES (795, 231084, 231000, '宁安市', NULL);
INSERT INTO `yh_regions` VALUES (796, 231085, 231000, '穆棱市', NULL);
INSERT INTO `yh_regions` VALUES (797, 231086, 231000, '东宁市', NULL);
INSERT INTO `yh_regions` VALUES (798, 231102, 231100, '爱辉区', NULL);
INSERT INTO `yh_regions` VALUES (799, 231121, 231100, '嫩江县', NULL);
INSERT INTO `yh_regions` VALUES (800, 231123, 231100, '逊克县', NULL);
INSERT INTO `yh_regions` VALUES (801, 231124, 231100, '孙吴县', NULL);
INSERT INTO `yh_regions` VALUES (802, 231181, 231100, '北安市', NULL);
INSERT INTO `yh_regions` VALUES (803, 231182, 231100, '五大连池市', NULL);
INSERT INTO `yh_regions` VALUES (804, 231202, 231200, '北林区', NULL);
INSERT INTO `yh_regions` VALUES (805, 231221, 231200, '望奎县', NULL);
INSERT INTO `yh_regions` VALUES (806, 231222, 231200, '兰西县', NULL);
INSERT INTO `yh_regions` VALUES (807, 231223, 231200, '青冈县', NULL);
INSERT INTO `yh_regions` VALUES (808, 231224, 231200, '庆安县', NULL);
INSERT INTO `yh_regions` VALUES (809, 231225, 231200, '明水县', NULL);
INSERT INTO `yh_regions` VALUES (810, 231226, 231200, '绥棱县', NULL);
INSERT INTO `yh_regions` VALUES (811, 231281, 231200, '安达市', NULL);
INSERT INTO `yh_regions` VALUES (812, 231282, 231200, '肇东市', NULL);
INSERT INTO `yh_regions` VALUES (813, 231283, 231200, '海伦市', NULL);
INSERT INTO `yh_regions` VALUES (814, 232701, 232700, '加格达奇区', NULL);
INSERT INTO `yh_regions` VALUES (815, 232721, 232700, '呼玛县', NULL);
INSERT INTO `yh_regions` VALUES (816, 232722, 232700, '塔河县', NULL);
INSERT INTO `yh_regions` VALUES (817, 232723, 232700, '漠河县', NULL);
INSERT INTO `yh_regions` VALUES (818, 310100, 310000, '上海城区', NULL);
INSERT INTO `yh_regions` VALUES (819, 310101, 310100, '黄浦区', NULL);
INSERT INTO `yh_regions` VALUES (820, 310104, 310100, '徐汇区', NULL);
INSERT INTO `yh_regions` VALUES (821, 310105, 310100, '长宁区', NULL);
INSERT INTO `yh_regions` VALUES (822, 310106, 310100, '静安区', NULL);
INSERT INTO `yh_regions` VALUES (823, 310107, 310100, '普陀区', NULL);
INSERT INTO `yh_regions` VALUES (824, 310109, 310100, '虹口区', NULL);
INSERT INTO `yh_regions` VALUES (825, 310110, 310100, '杨浦区', NULL);
INSERT INTO `yh_regions` VALUES (826, 310112, 310100, '闵行区', NULL);
INSERT INTO `yh_regions` VALUES (827, 310113, 310100, '宝山区', NULL);
INSERT INTO `yh_regions` VALUES (828, 310114, 310100, '嘉定区', NULL);
INSERT INTO `yh_regions` VALUES (829, 310115, 310100, '浦东新区', NULL);
INSERT INTO `yh_regions` VALUES (830, 310116, 310100, '金山区', NULL);
INSERT INTO `yh_regions` VALUES (831, 310117, 310100, '松江区', NULL);
INSERT INTO `yh_regions` VALUES (832, 310118, 310100, '青浦区', NULL);
INSERT INTO `yh_regions` VALUES (833, 310120, 310100, '奉贤区', NULL);
INSERT INTO `yh_regions` VALUES (834, 310151, 310100, '崇明区', NULL);
INSERT INTO `yh_regions` VALUES (835, 320100, 320000, '南京市', NULL);
INSERT INTO `yh_regions` VALUES (836, 320200, 320000, '无锡市', NULL);
INSERT INTO `yh_regions` VALUES (837, 320300, 320000, '徐州市', NULL);
INSERT INTO `yh_regions` VALUES (838, 320400, 320000, '常州市', NULL);
INSERT INTO `yh_regions` VALUES (839, 320500, 320000, '苏州市', NULL);
INSERT INTO `yh_regions` VALUES (840, 320600, 320000, '南通市', NULL);
INSERT INTO `yh_regions` VALUES (841, 320700, 320000, '连云港市', NULL);
INSERT INTO `yh_regions` VALUES (842, 320800, 320000, '淮安市', NULL);
INSERT INTO `yh_regions` VALUES (843, 320900, 320000, '盐城市', NULL);
INSERT INTO `yh_regions` VALUES (844, 321000, 320000, '扬州市', NULL);
INSERT INTO `yh_regions` VALUES (845, 321100, 320000, '镇江市', NULL);
INSERT INTO `yh_regions` VALUES (846, 321200, 320000, '泰州市', NULL);
INSERT INTO `yh_regions` VALUES (847, 321300, 320000, '宿迁市', NULL);
INSERT INTO `yh_regions` VALUES (848, 320102, 320100, '玄武区', NULL);
INSERT INTO `yh_regions` VALUES (849, 320104, 320100, '秦淮区', NULL);
INSERT INTO `yh_regions` VALUES (850, 320105, 320100, '建邺区', NULL);
INSERT INTO `yh_regions` VALUES (851, 320106, 320100, '鼓楼区', NULL);
INSERT INTO `yh_regions` VALUES (852, 320111, 320100, '浦口区', NULL);
INSERT INTO `yh_regions` VALUES (853, 320113, 320100, '栖霞区', NULL);
INSERT INTO `yh_regions` VALUES (854, 320114, 320100, '雨花台区', NULL);
INSERT INTO `yh_regions` VALUES (855, 320115, 320100, '江宁区', NULL);
INSERT INTO `yh_regions` VALUES (856, 320116, 320100, '六合区', NULL);
INSERT INTO `yh_regions` VALUES (857, 320117, 320100, '溧水区', NULL);
INSERT INTO `yh_regions` VALUES (858, 320118, 320100, '高淳区', NULL);
INSERT INTO `yh_regions` VALUES (859, 320205, 320200, '锡山区', NULL);
INSERT INTO `yh_regions` VALUES (860, 320206, 320200, '惠山区', NULL);
INSERT INTO `yh_regions` VALUES (861, 320211, 320200, '滨湖区', NULL);
INSERT INTO `yh_regions` VALUES (862, 320213, 320200, '梁溪区', NULL);
INSERT INTO `yh_regions` VALUES (863, 320214, 320200, '新吴区', NULL);
INSERT INTO `yh_regions` VALUES (864, 320281, 320200, '江阴市', NULL);
INSERT INTO `yh_regions` VALUES (865, 320282, 320200, '宜兴市', NULL);
INSERT INTO `yh_regions` VALUES (866, 320302, 320300, '鼓楼区', NULL);
INSERT INTO `yh_regions` VALUES (867, 320303, 320300, '云龙区', NULL);
INSERT INTO `yh_regions` VALUES (868, 320305, 320300, '贾汪区', NULL);
INSERT INTO `yh_regions` VALUES (869, 320311, 320300, '泉山区', NULL);
INSERT INTO `yh_regions` VALUES (870, 320312, 320300, '铜山区', NULL);
INSERT INTO `yh_regions` VALUES (871, 320321, 320300, '丰县', NULL);
INSERT INTO `yh_regions` VALUES (872, 320322, 320300, '沛县', NULL);
INSERT INTO `yh_regions` VALUES (873, 320324, 320300, '睢宁县', NULL);
INSERT INTO `yh_regions` VALUES (874, 320381, 320300, '新沂市', NULL);
INSERT INTO `yh_regions` VALUES (875, 320382, 320300, '邳州市', NULL);
INSERT INTO `yh_regions` VALUES (876, 320402, 320400, '天宁区', NULL);
INSERT INTO `yh_regions` VALUES (877, 320404, 320400, '钟楼区', NULL);
INSERT INTO `yh_regions` VALUES (878, 320411, 320400, '新北区', NULL);
INSERT INTO `yh_regions` VALUES (879, 320412, 320400, '武进区', NULL);
INSERT INTO `yh_regions` VALUES (880, 320413, 320400, '金坛区', NULL);
INSERT INTO `yh_regions` VALUES (881, 320481, 320400, '溧阳市', NULL);
INSERT INTO `yh_regions` VALUES (882, 320505, 320500, '虎丘区', NULL);
INSERT INTO `yh_regions` VALUES (883, 320506, 320500, '吴中区', NULL);
INSERT INTO `yh_regions` VALUES (884, 320507, 320500, '相城区', NULL);
INSERT INTO `yh_regions` VALUES (885, 320508, 320500, '姑苏区', NULL);
INSERT INTO `yh_regions` VALUES (886, 320509, 320500, '吴江区', NULL);
INSERT INTO `yh_regions` VALUES (887, 320581, 320500, '常熟市', NULL);
INSERT INTO `yh_regions` VALUES (888, 320582, 320500, '张家港市', NULL);
INSERT INTO `yh_regions` VALUES (889, 320583, 320500, '昆山市', NULL);
INSERT INTO `yh_regions` VALUES (890, 320585, 320500, '太仓市', NULL);
INSERT INTO `yh_regions` VALUES (891, 320602, 320600, '崇川区', NULL);
INSERT INTO `yh_regions` VALUES (892, 320611, 320600, '港闸区', NULL);
INSERT INTO `yh_regions` VALUES (893, 320612, 320600, '通州区', NULL);
INSERT INTO `yh_regions` VALUES (894, 320621, 320600, '海安县', NULL);
INSERT INTO `yh_regions` VALUES (895, 320623, 320600, '如东县', NULL);
INSERT INTO `yh_regions` VALUES (896, 320681, 320600, '启东市', NULL);
INSERT INTO `yh_regions` VALUES (897, 320682, 320600, '如皋市', NULL);
INSERT INTO `yh_regions` VALUES (898, 320684, 320600, '海门市', NULL);
INSERT INTO `yh_regions` VALUES (899, 320703, 320700, '连云区', NULL);
INSERT INTO `yh_regions` VALUES (900, 320706, 320700, '海州区', NULL);
INSERT INTO `yh_regions` VALUES (901, 320707, 320700, '赣榆区', NULL);
INSERT INTO `yh_regions` VALUES (902, 320722, 320700, '东海县', NULL);
INSERT INTO `yh_regions` VALUES (903, 320723, 320700, '灌云县', NULL);
INSERT INTO `yh_regions` VALUES (904, 320724, 320700, '灌南县', NULL);
INSERT INTO `yh_regions` VALUES (905, 320803, 320800, '淮安区', NULL);
INSERT INTO `yh_regions` VALUES (906, 320804, 320800, '淮阴区', NULL);
INSERT INTO `yh_regions` VALUES (907, 320812, 320800, '清江浦区', NULL);
INSERT INTO `yh_regions` VALUES (908, 320813, 320800, '洪泽区', NULL);
INSERT INTO `yh_regions` VALUES (909, 320826, 320800, '涟水县', NULL);
INSERT INTO `yh_regions` VALUES (910, 320830, 320800, '盱眙县', NULL);
INSERT INTO `yh_regions` VALUES (911, 320831, 320800, '金湖县', NULL);
INSERT INTO `yh_regions` VALUES (912, 320902, 320900, '亭湖区', NULL);
INSERT INTO `yh_regions` VALUES (913, 320903, 320900, '盐都区', NULL);
INSERT INTO `yh_regions` VALUES (914, 320904, 320900, '大丰区', NULL);
INSERT INTO `yh_regions` VALUES (915, 320921, 320900, '响水县', NULL);
INSERT INTO `yh_regions` VALUES (916, 320922, 320900, '滨海县', NULL);
INSERT INTO `yh_regions` VALUES (917, 320923, 320900, '阜宁县', NULL);
INSERT INTO `yh_regions` VALUES (918, 320924, 320900, '射阳县', NULL);
INSERT INTO `yh_regions` VALUES (919, 320925, 320900, '建湖县', NULL);
INSERT INTO `yh_regions` VALUES (920, 320981, 320900, '东台市', NULL);
INSERT INTO `yh_regions` VALUES (921, 321002, 321000, '广陵区', NULL);
INSERT INTO `yh_regions` VALUES (922, 321003, 321000, '邗江区', NULL);
INSERT INTO `yh_regions` VALUES (923, 321012, 321000, '江都区', NULL);
INSERT INTO `yh_regions` VALUES (924, 321023, 321000, '宝应县', NULL);
INSERT INTO `yh_regions` VALUES (925, 321081, 321000, '仪征市', NULL);
INSERT INTO `yh_regions` VALUES (926, 321084, 321000, '高邮市', NULL);
INSERT INTO `yh_regions` VALUES (927, 321102, 321100, '京口区', NULL);
INSERT INTO `yh_regions` VALUES (928, 321111, 321100, '润州区', NULL);
INSERT INTO `yh_regions` VALUES (929, 321112, 321100, '丹徒区', NULL);
INSERT INTO `yh_regions` VALUES (930, 321181, 321100, '丹阳市', NULL);
INSERT INTO `yh_regions` VALUES (931, 321182, 321100, '扬中市', NULL);
INSERT INTO `yh_regions` VALUES (932, 321183, 321100, '句容市', NULL);
INSERT INTO `yh_regions` VALUES (933, 321202, 321200, '海陵区', NULL);
INSERT INTO `yh_regions` VALUES (934, 321203, 321200, '高港区', NULL);
INSERT INTO `yh_regions` VALUES (935, 321204, 321200, '姜堰区', NULL);
INSERT INTO `yh_regions` VALUES (936, 321281, 321200, '兴化市', NULL);
INSERT INTO `yh_regions` VALUES (937, 321282, 321200, '靖江市', NULL);
INSERT INTO `yh_regions` VALUES (938, 321283, 321200, '泰兴市', NULL);
INSERT INTO `yh_regions` VALUES (939, 321302, 321300, '宿城区', NULL);
INSERT INTO `yh_regions` VALUES (940, 321311, 321300, '宿豫区', NULL);
INSERT INTO `yh_regions` VALUES (941, 321322, 321300, '沭阳县', NULL);
INSERT INTO `yh_regions` VALUES (942, 321323, 321300, '泗阳县', NULL);
INSERT INTO `yh_regions` VALUES (943, 321324, 321300, '泗洪县', NULL);
INSERT INTO `yh_regions` VALUES (944, 330100, 330000, '杭州市', NULL);
INSERT INTO `yh_regions` VALUES (945, 330200, 330000, '宁波市', NULL);
INSERT INTO `yh_regions` VALUES (946, 330300, 330000, '温州市', NULL);
INSERT INTO `yh_regions` VALUES (947, 330400, 330000, '嘉兴市', NULL);
INSERT INTO `yh_regions` VALUES (948, 330500, 330000, '湖州市', NULL);
INSERT INTO `yh_regions` VALUES (949, 330600, 330000, '绍兴市', NULL);
INSERT INTO `yh_regions` VALUES (950, 330700, 330000, '金华市', NULL);
INSERT INTO `yh_regions` VALUES (951, 330800, 330000, '衢州市', NULL);
INSERT INTO `yh_regions` VALUES (952, 330900, 330000, '舟山市', NULL);
INSERT INTO `yh_regions` VALUES (953, 331000, 330000, '台州市', NULL);
INSERT INTO `yh_regions` VALUES (954, 331100, 330000, '丽水市', NULL);
INSERT INTO `yh_regions` VALUES (955, 330102, 330100, '上城区', NULL);
INSERT INTO `yh_regions` VALUES (956, 330103, 330100, '下城区', NULL);
INSERT INTO `yh_regions` VALUES (957, 330104, 330100, '江干区', NULL);
INSERT INTO `yh_regions` VALUES (958, 330105, 330100, '拱墅区', NULL);
INSERT INTO `yh_regions` VALUES (959, 330106, 330100, '西湖区', NULL);
INSERT INTO `yh_regions` VALUES (960, 330108, 330100, '滨江区', NULL);
INSERT INTO `yh_regions` VALUES (961, 330109, 330100, '萧山区', NULL);
INSERT INTO `yh_regions` VALUES (962, 330110, 330100, '余杭区', NULL);
INSERT INTO `yh_regions` VALUES (963, 330111, 330100, '富阳区', NULL);
INSERT INTO `yh_regions` VALUES (964, 330112, 330100, '临安区', NULL);
INSERT INTO `yh_regions` VALUES (965, 330122, 330100, '桐庐县', NULL);
INSERT INTO `yh_regions` VALUES (966, 330127, 330100, '淳安县', NULL);
INSERT INTO `yh_regions` VALUES (967, 330182, 330100, '建德市', NULL);
INSERT INTO `yh_regions` VALUES (968, 330203, 330200, '海曙区', NULL);
INSERT INTO `yh_regions` VALUES (969, 330205, 330200, '江北区', NULL);
INSERT INTO `yh_regions` VALUES (970, 330206, 330200, '北仑区', NULL);
INSERT INTO `yh_regions` VALUES (971, 330211, 330200, '镇海区', NULL);
INSERT INTO `yh_regions` VALUES (972, 330212, 330200, '鄞州区', NULL);
INSERT INTO `yh_regions` VALUES (973, 330213, 330200, '奉化区', NULL);
INSERT INTO `yh_regions` VALUES (974, 330225, 330200, '象山县', NULL);
INSERT INTO `yh_regions` VALUES (975, 330226, 330200, '宁海县', NULL);
INSERT INTO `yh_regions` VALUES (976, 330281, 330200, '余姚市', NULL);
INSERT INTO `yh_regions` VALUES (977, 330282, 330200, '慈溪市', NULL);
INSERT INTO `yh_regions` VALUES (978, 330302, 330300, '鹿城区', NULL);
INSERT INTO `yh_regions` VALUES (979, 330303, 330300, '龙湾区', NULL);
INSERT INTO `yh_regions` VALUES (980, 330304, 330300, '瓯海区', NULL);
INSERT INTO `yh_regions` VALUES (981, 330305, 330300, '洞头区', NULL);
INSERT INTO `yh_regions` VALUES (982, 330324, 330300, '永嘉县', NULL);
INSERT INTO `yh_regions` VALUES (983, 330326, 330300, '平阳县', NULL);
INSERT INTO `yh_regions` VALUES (984, 330327, 330300, '苍南县', NULL);
INSERT INTO `yh_regions` VALUES (985, 330328, 330300, '文成县', NULL);
INSERT INTO `yh_regions` VALUES (986, 330329, 330300, '泰顺县', NULL);
INSERT INTO `yh_regions` VALUES (987, 330381, 330300, '瑞安市', NULL);
INSERT INTO `yh_regions` VALUES (988, 330382, 330300, '乐清市', NULL);
INSERT INTO `yh_regions` VALUES (989, 330402, 330400, '南湖区', NULL);
INSERT INTO `yh_regions` VALUES (990, 330411, 330400, '秀洲区', NULL);
INSERT INTO `yh_regions` VALUES (991, 330421, 330400, '嘉善县', NULL);
INSERT INTO `yh_regions` VALUES (992, 330424, 330400, '海盐县', NULL);
INSERT INTO `yh_regions` VALUES (993, 330481, 330400, '海宁市', NULL);
INSERT INTO `yh_regions` VALUES (994, 330482, 330400, '平湖市', NULL);
INSERT INTO `yh_regions` VALUES (995, 330483, 330400, '桐乡市', NULL);
INSERT INTO `yh_regions` VALUES (996, 330502, 330500, '吴兴区', NULL);
INSERT INTO `yh_regions` VALUES (997, 330503, 330500, '南浔区', NULL);
INSERT INTO `yh_regions` VALUES (998, 330521, 330500, '德清县', NULL);
INSERT INTO `yh_regions` VALUES (999, 330522, 330500, '长兴县', NULL);
INSERT INTO `yh_regions` VALUES (1000, 330523, 330500, '安吉县', NULL);
INSERT INTO `yh_regions` VALUES (1001, 330602, 330600, '越城区', NULL);
INSERT INTO `yh_regions` VALUES (1002, 330603, 330600, '柯桥区', NULL);
INSERT INTO `yh_regions` VALUES (1003, 330604, 330600, '上虞区', NULL);
INSERT INTO `yh_regions` VALUES (1004, 330624, 330600, '新昌县', NULL);
INSERT INTO `yh_regions` VALUES (1005, 330681, 330600, '诸暨市', NULL);
INSERT INTO `yh_regions` VALUES (1006, 330683, 330600, '嵊州市', NULL);
INSERT INTO `yh_regions` VALUES (1007, 330702, 330700, '婺城区', NULL);
INSERT INTO `yh_regions` VALUES (1008, 330703, 330700, '金东区', NULL);
INSERT INTO `yh_regions` VALUES (1009, 330723, 330700, '武义县', NULL);
INSERT INTO `yh_regions` VALUES (1010, 330726, 330700, '浦江县', NULL);
INSERT INTO `yh_regions` VALUES (1011, 330727, 330700, '磐安县', NULL);
INSERT INTO `yh_regions` VALUES (1012, 330781, 330700, '兰溪市', NULL);
INSERT INTO `yh_regions` VALUES (1013, 330782, 330700, '义乌市', NULL);
INSERT INTO `yh_regions` VALUES (1014, 330783, 330700, '东阳市', NULL);
INSERT INTO `yh_regions` VALUES (1015, 330784, 330700, '永康市', NULL);
INSERT INTO `yh_regions` VALUES (1016, 330802, 330800, '柯城区', NULL);
INSERT INTO `yh_regions` VALUES (1017, 330803, 330800, '衢江区', NULL);
INSERT INTO `yh_regions` VALUES (1018, 330822, 330800, '常山县', NULL);
INSERT INTO `yh_regions` VALUES (1019, 330824, 330800, '开化县', NULL);
INSERT INTO `yh_regions` VALUES (1020, 330825, 330800, '龙游县', NULL);
INSERT INTO `yh_regions` VALUES (1021, 330881, 330800, '江山市', NULL);
INSERT INTO `yh_regions` VALUES (1022, 330902, 330900, '定海区', NULL);
INSERT INTO `yh_regions` VALUES (1023, 330903, 330900, '普陀区', NULL);
INSERT INTO `yh_regions` VALUES (1024, 330921, 330900, '岱山县', NULL);
INSERT INTO `yh_regions` VALUES (1025, 330922, 330900, '嵊泗县', NULL);
INSERT INTO `yh_regions` VALUES (1026, 331002, 331000, '椒江区', NULL);
INSERT INTO `yh_regions` VALUES (1027, 331003, 331000, '黄岩区', NULL);
INSERT INTO `yh_regions` VALUES (1028, 331004, 331000, '路桥区', NULL);
INSERT INTO `yh_regions` VALUES (1029, 331022, 331000, '三门县', NULL);
INSERT INTO `yh_regions` VALUES (1030, 331023, 331000, '天台县', NULL);
INSERT INTO `yh_regions` VALUES (1031, 331024, 331000, '仙居县', NULL);
INSERT INTO `yh_regions` VALUES (1032, 331081, 331000, '温岭市', NULL);
INSERT INTO `yh_regions` VALUES (1033, 331082, 331000, '临海市', NULL);
INSERT INTO `yh_regions` VALUES (1034, 331083, 331000, '玉环市', NULL);
INSERT INTO `yh_regions` VALUES (1035, 331102, 331100, '莲都区', NULL);
INSERT INTO `yh_regions` VALUES (1036, 331121, 331100, '青田县', NULL);
INSERT INTO `yh_regions` VALUES (1037, 331122, 331100, '缙云县', NULL);
INSERT INTO `yh_regions` VALUES (1038, 331123, 331100, '遂昌县', NULL);
INSERT INTO `yh_regions` VALUES (1039, 331124, 331100, '松阳县', NULL);
INSERT INTO `yh_regions` VALUES (1040, 331125, 331100, '云和县', NULL);
INSERT INTO `yh_regions` VALUES (1041, 331126, 331100, '庆元县', NULL);
INSERT INTO `yh_regions` VALUES (1042, 331127, 331100, '景宁畲族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1043, 331181, 331100, '龙泉市', NULL);
INSERT INTO `yh_regions` VALUES (1044, 340100, 340000, '合肥市', NULL);
INSERT INTO `yh_regions` VALUES (1045, 340200, 340000, '芜湖市', NULL);
INSERT INTO `yh_regions` VALUES (1046, 340300, 340000, '蚌埠市', NULL);
INSERT INTO `yh_regions` VALUES (1047, 340400, 340000, '淮南市', NULL);
INSERT INTO `yh_regions` VALUES (1048, 340500, 340000, '马鞍山市', NULL);
INSERT INTO `yh_regions` VALUES (1049, 340600, 340000, '淮北市', NULL);
INSERT INTO `yh_regions` VALUES (1050, 340700, 340000, '铜陵市', NULL);
INSERT INTO `yh_regions` VALUES (1051, 340800, 340000, '安庆市', NULL);
INSERT INTO `yh_regions` VALUES (1052, 341000, 340000, '黄山市', NULL);
INSERT INTO `yh_regions` VALUES (1053, 341100, 340000, '滁州市', NULL);
INSERT INTO `yh_regions` VALUES (1054, 341200, 340000, '阜阳市', NULL);
INSERT INTO `yh_regions` VALUES (1055, 341300, 340000, '宿州市', NULL);
INSERT INTO `yh_regions` VALUES (1056, 341500, 340000, '六安市', NULL);
INSERT INTO `yh_regions` VALUES (1057, 341600, 340000, '亳州市', NULL);
INSERT INTO `yh_regions` VALUES (1058, 341700, 340000, '池州市', NULL);
INSERT INTO `yh_regions` VALUES (1059, 341800, 340000, '宣城市', NULL);
INSERT INTO `yh_regions` VALUES (1060, 340102, 340100, '瑶海区', NULL);
INSERT INTO `yh_regions` VALUES (1061, 340103, 340100, '庐阳区', NULL);
INSERT INTO `yh_regions` VALUES (1062, 340104, 340100, '蜀山区', NULL);
INSERT INTO `yh_regions` VALUES (1063, 340111, 340100, '包河区', NULL);
INSERT INTO `yh_regions` VALUES (1064, 340121, 340100, '长丰县', NULL);
INSERT INTO `yh_regions` VALUES (1065, 340122, 340100, '肥东县', NULL);
INSERT INTO `yh_regions` VALUES (1066, 340123, 340100, '肥西县', NULL);
INSERT INTO `yh_regions` VALUES (1067, 340124, 340100, '庐江县', NULL);
INSERT INTO `yh_regions` VALUES (1068, 340181, 340100, '巢湖市', NULL);
INSERT INTO `yh_regions` VALUES (1069, 340202, 340200, '镜湖区', NULL);
INSERT INTO `yh_regions` VALUES (1070, 340203, 340200, '弋江区', NULL);
INSERT INTO `yh_regions` VALUES (1071, 340207, 340200, '鸠江区', NULL);
INSERT INTO `yh_regions` VALUES (1072, 340208, 340200, '三山区', NULL);
INSERT INTO `yh_regions` VALUES (1073, 340221, 340200, '芜湖县', NULL);
INSERT INTO `yh_regions` VALUES (1074, 340222, 340200, '繁昌县', NULL);
INSERT INTO `yh_regions` VALUES (1075, 340223, 340200, '南陵县', NULL);
INSERT INTO `yh_regions` VALUES (1076, 340225, 340200, '无为县', NULL);
INSERT INTO `yh_regions` VALUES (1077, 340302, 340300, '龙子湖区', NULL);
INSERT INTO `yh_regions` VALUES (1078, 340303, 340300, '蚌山区', NULL);
INSERT INTO `yh_regions` VALUES (1079, 340304, 340300, '禹会区', NULL);
INSERT INTO `yh_regions` VALUES (1080, 340311, 340300, '淮上区', NULL);
INSERT INTO `yh_regions` VALUES (1081, 340321, 340300, '怀远县', NULL);
INSERT INTO `yh_regions` VALUES (1082, 340322, 340300, '五河县', NULL);
INSERT INTO `yh_regions` VALUES (1083, 340323, 340300, '固镇县', NULL);
INSERT INTO `yh_regions` VALUES (1084, 340402, 340400, '大通区', NULL);
INSERT INTO `yh_regions` VALUES (1085, 340403, 340400, '田家庵区', NULL);
INSERT INTO `yh_regions` VALUES (1086, 340404, 340400, '谢家集区', NULL);
INSERT INTO `yh_regions` VALUES (1087, 340405, 340400, '八公山区', NULL);
INSERT INTO `yh_regions` VALUES (1088, 340406, 340400, '潘集区', NULL);
INSERT INTO `yh_regions` VALUES (1089, 340421, 340400, '凤台县', NULL);
INSERT INTO `yh_regions` VALUES (1090, 340422, 340400, '寿县', NULL);
INSERT INTO `yh_regions` VALUES (1091, 340503, 340500, '花山区', NULL);
INSERT INTO `yh_regions` VALUES (1092, 340504, 340500, '雨山区', NULL);
INSERT INTO `yh_regions` VALUES (1093, 340506, 340500, '博望区', NULL);
INSERT INTO `yh_regions` VALUES (1094, 340521, 340500, '当涂县', NULL);
INSERT INTO `yh_regions` VALUES (1095, 340522, 340500, '含山县', NULL);
INSERT INTO `yh_regions` VALUES (1096, 340523, 340500, '和县', NULL);
INSERT INTO `yh_regions` VALUES (1097, 340602, 340600, '杜集区', NULL);
INSERT INTO `yh_regions` VALUES (1098, 340603, 340600, '相山区', NULL);
INSERT INTO `yh_regions` VALUES (1099, 340604, 340600, '烈山区', NULL);
INSERT INTO `yh_regions` VALUES (1100, 340621, 340600, '濉溪县', NULL);
INSERT INTO `yh_regions` VALUES (1101, 340705, 340700, '铜官区', NULL);
INSERT INTO `yh_regions` VALUES (1102, 340706, 340700, '义安区', NULL);
INSERT INTO `yh_regions` VALUES (1103, 340711, 340700, '郊区', NULL);
INSERT INTO `yh_regions` VALUES (1104, 340722, 340700, '枞阳县', NULL);
INSERT INTO `yh_regions` VALUES (1105, 340802, 340800, '迎江区', NULL);
INSERT INTO `yh_regions` VALUES (1106, 340803, 340800, '大观区', NULL);
INSERT INTO `yh_regions` VALUES (1107, 340811, 340800, '宜秀区', NULL);
INSERT INTO `yh_regions` VALUES (1108, 340822, 340800, '怀宁县', NULL);
INSERT INTO `yh_regions` VALUES (1109, 340824, 340800, '潜山县', NULL);
INSERT INTO `yh_regions` VALUES (1110, 340825, 340800, '太湖县', NULL);
INSERT INTO `yh_regions` VALUES (1111, 340826, 340800, '宿松县', NULL);
INSERT INTO `yh_regions` VALUES (1112, 340827, 340800, '望江县', NULL);
INSERT INTO `yh_regions` VALUES (1113, 340828, 340800, '岳西县', NULL);
INSERT INTO `yh_regions` VALUES (1114, 340881, 340800, '桐城市', NULL);
INSERT INTO `yh_regions` VALUES (1115, 341002, 341000, '屯溪区', NULL);
INSERT INTO `yh_regions` VALUES (1116, 341003, 341000, '黄山区', NULL);
INSERT INTO `yh_regions` VALUES (1117, 341004, 341000, '徽州区', NULL);
INSERT INTO `yh_regions` VALUES (1118, 341021, 341000, '歙县', NULL);
INSERT INTO `yh_regions` VALUES (1119, 341022, 341000, '休宁县', NULL);
INSERT INTO `yh_regions` VALUES (1120, 341023, 341000, '黟县', NULL);
INSERT INTO `yh_regions` VALUES (1121, 341024, 341000, '祁门县', NULL);
INSERT INTO `yh_regions` VALUES (1122, 341102, 341100, '琅琊区', NULL);
INSERT INTO `yh_regions` VALUES (1123, 341103, 341100, '南谯区', NULL);
INSERT INTO `yh_regions` VALUES (1124, 341122, 341100, '来安县', NULL);
INSERT INTO `yh_regions` VALUES (1125, 341124, 341100, '全椒县', NULL);
INSERT INTO `yh_regions` VALUES (1126, 341125, 341100, '定远县', NULL);
INSERT INTO `yh_regions` VALUES (1127, 341126, 341100, '凤阳县', NULL);
INSERT INTO `yh_regions` VALUES (1128, 341181, 341100, '天长市', NULL);
INSERT INTO `yh_regions` VALUES (1129, 341182, 341100, '明光市', NULL);
INSERT INTO `yh_regions` VALUES (1130, 341202, 341200, '颍州区', NULL);
INSERT INTO `yh_regions` VALUES (1131, 341203, 341200, '颍东区', NULL);
INSERT INTO `yh_regions` VALUES (1132, 341204, 341200, '颍泉区', NULL);
INSERT INTO `yh_regions` VALUES (1133, 341221, 341200, '临泉县', NULL);
INSERT INTO `yh_regions` VALUES (1134, 341222, 341200, '太和县', NULL);
INSERT INTO `yh_regions` VALUES (1135, 341225, 341200, '阜南县', NULL);
INSERT INTO `yh_regions` VALUES (1136, 341226, 341200, '颍上县', NULL);
INSERT INTO `yh_regions` VALUES (1137, 341282, 341200, '界首市', NULL);
INSERT INTO `yh_regions` VALUES (1138, 341302, 341300, '埇桥区', NULL);
INSERT INTO `yh_regions` VALUES (1139, 341321, 341300, '砀山县', NULL);
INSERT INTO `yh_regions` VALUES (1140, 341322, 341300, '萧县', NULL);
INSERT INTO `yh_regions` VALUES (1141, 341323, 341300, '灵璧县', NULL);
INSERT INTO `yh_regions` VALUES (1142, 341324, 341300, '泗县', NULL);
INSERT INTO `yh_regions` VALUES (1143, 341502, 341500, '金安区', NULL);
INSERT INTO `yh_regions` VALUES (1144, 341503, 341500, '裕安区', NULL);
INSERT INTO `yh_regions` VALUES (1145, 341504, 341500, '叶集区', NULL);
INSERT INTO `yh_regions` VALUES (1146, 341522, 341500, '霍邱县', NULL);
INSERT INTO `yh_regions` VALUES (1147, 341523, 341500, '舒城县', NULL);
INSERT INTO `yh_regions` VALUES (1148, 341524, 341500, '金寨县', NULL);
INSERT INTO `yh_regions` VALUES (1149, 341525, 341500, '霍山县', NULL);
INSERT INTO `yh_regions` VALUES (1150, 341602, 341600, '谯城区', NULL);
INSERT INTO `yh_regions` VALUES (1151, 341621, 341600, '涡阳县', NULL);
INSERT INTO `yh_regions` VALUES (1152, 341622, 341600, '蒙城县', NULL);
INSERT INTO `yh_regions` VALUES (1153, 341623, 341600, '利辛县', NULL);
INSERT INTO `yh_regions` VALUES (1154, 341702, 341700, '贵池区', NULL);
INSERT INTO `yh_regions` VALUES (1155, 341721, 341700, '东至县', NULL);
INSERT INTO `yh_regions` VALUES (1156, 341722, 341700, '石台县', NULL);
INSERT INTO `yh_regions` VALUES (1157, 341723, 341700, '青阳县', NULL);
INSERT INTO `yh_regions` VALUES (1158, 341802, 341800, '宣州区', NULL);
INSERT INTO `yh_regions` VALUES (1159, 341821, 341800, '郎溪县', NULL);
INSERT INTO `yh_regions` VALUES (1160, 341822, 341800, '广德县', NULL);
INSERT INTO `yh_regions` VALUES (1161, 341823, 341800, '泾县', NULL);
INSERT INTO `yh_regions` VALUES (1162, 341824, 341800, '绩溪县', NULL);
INSERT INTO `yh_regions` VALUES (1163, 341825, 341800, '旌德县', NULL);
INSERT INTO `yh_regions` VALUES (1164, 341881, 341800, '宁国市', NULL);
INSERT INTO `yh_regions` VALUES (1165, 350100, 350000, '福州市', NULL);
INSERT INTO `yh_regions` VALUES (1166, 350200, 350000, '厦门市', NULL);
INSERT INTO `yh_regions` VALUES (1167, 350300, 350000, '莆田市', NULL);
INSERT INTO `yh_regions` VALUES (1168, 350400, 350000, '三明市', NULL);
INSERT INTO `yh_regions` VALUES (1169, 350500, 350000, '泉州市', NULL);
INSERT INTO `yh_regions` VALUES (1170, 350600, 350000, '漳州市', NULL);
INSERT INTO `yh_regions` VALUES (1171, 350700, 350000, '南平市', NULL);
INSERT INTO `yh_regions` VALUES (1172, 350800, 350000, '龙岩市', NULL);
INSERT INTO `yh_regions` VALUES (1173, 350900, 350000, '宁德市', NULL);
INSERT INTO `yh_regions` VALUES (1174, 350102, 350100, '鼓楼区', NULL);
INSERT INTO `yh_regions` VALUES (1175, 350103, 350100, '台江区', NULL);
INSERT INTO `yh_regions` VALUES (1176, 350104, 350100, '仓山区', NULL);
INSERT INTO `yh_regions` VALUES (1177, 350105, 350100, '马尾区', NULL);
INSERT INTO `yh_regions` VALUES (1178, 350111, 350100, '晋安区', NULL);
INSERT INTO `yh_regions` VALUES (1179, 350112, 350100, '长乐区', NULL);
INSERT INTO `yh_regions` VALUES (1180, 350121, 350100, '闽侯县', NULL);
INSERT INTO `yh_regions` VALUES (1181, 350122, 350100, '连江县', NULL);
INSERT INTO `yh_regions` VALUES (1182, 350123, 350100, '罗源县', NULL);
INSERT INTO `yh_regions` VALUES (1183, 350124, 350100, '闽清县', NULL);
INSERT INTO `yh_regions` VALUES (1184, 350125, 350100, '永泰县', NULL);
INSERT INTO `yh_regions` VALUES (1185, 350128, 350100, '平潭县', NULL);
INSERT INTO `yh_regions` VALUES (1186, 350181, 350100, '福清市', NULL);
INSERT INTO `yh_regions` VALUES (1187, 350203, 350200, '思明区', NULL);
INSERT INTO `yh_regions` VALUES (1188, 350205, 350200, '海沧区', NULL);
INSERT INTO `yh_regions` VALUES (1189, 350206, 350200, '湖里区', NULL);
INSERT INTO `yh_regions` VALUES (1190, 350211, 350200, '集美区', NULL);
INSERT INTO `yh_regions` VALUES (1191, 350212, 350200, '同安区', NULL);
INSERT INTO `yh_regions` VALUES (1192, 350213, 350200, '翔安区', NULL);
INSERT INTO `yh_regions` VALUES (1193, 350302, 350300, '城厢区', NULL);
INSERT INTO `yh_regions` VALUES (1194, 350303, 350300, '涵江区', NULL);
INSERT INTO `yh_regions` VALUES (1195, 350304, 350300, '荔城区', NULL);
INSERT INTO `yh_regions` VALUES (1196, 350305, 350300, '秀屿区', NULL);
INSERT INTO `yh_regions` VALUES (1197, 350322, 350300, '仙游县', NULL);
INSERT INTO `yh_regions` VALUES (1198, 350402, 350400, '梅列区', NULL);
INSERT INTO `yh_regions` VALUES (1199, 350403, 350400, '三元区', NULL);
INSERT INTO `yh_regions` VALUES (1200, 350421, 350400, '明溪县', NULL);
INSERT INTO `yh_regions` VALUES (1201, 350423, 350400, '清流县', NULL);
INSERT INTO `yh_regions` VALUES (1202, 350424, 350400, '宁化县', NULL);
INSERT INTO `yh_regions` VALUES (1203, 350425, 350400, '大田县', NULL);
INSERT INTO `yh_regions` VALUES (1204, 350426, 350400, '尤溪县', NULL);
INSERT INTO `yh_regions` VALUES (1205, 350427, 350400, '沙县', NULL);
INSERT INTO `yh_regions` VALUES (1206, 350428, 350400, '将乐县', NULL);
INSERT INTO `yh_regions` VALUES (1207, 350429, 350400, '泰宁县', NULL);
INSERT INTO `yh_regions` VALUES (1208, 350430, 350400, '建宁县', NULL);
INSERT INTO `yh_regions` VALUES (1209, 350481, 350400, '永安市', NULL);
INSERT INTO `yh_regions` VALUES (1210, 350502, 350500, '鲤城区', NULL);
INSERT INTO `yh_regions` VALUES (1211, 350503, 350500, '丰泽区', NULL);
INSERT INTO `yh_regions` VALUES (1212, 350504, 350500, '洛江区', NULL);
INSERT INTO `yh_regions` VALUES (1213, 350505, 350500, '泉港区', NULL);
INSERT INTO `yh_regions` VALUES (1214, 350521, 350500, '惠安县', NULL);
INSERT INTO `yh_regions` VALUES (1215, 350524, 350500, '安溪县', NULL);
INSERT INTO `yh_regions` VALUES (1216, 350525, 350500, '永春县', NULL);
INSERT INTO `yh_regions` VALUES (1217, 350526, 350500, '德化县', NULL);
INSERT INTO `yh_regions` VALUES (1218, 350527, 350500, '金门县', NULL);
INSERT INTO `yh_regions` VALUES (1219, 350581, 350500, '石狮市', NULL);
INSERT INTO `yh_regions` VALUES (1220, 350582, 350500, '晋江市', NULL);
INSERT INTO `yh_regions` VALUES (1221, 350583, 350500, '南安市', NULL);
INSERT INTO `yh_regions` VALUES (1222, 350602, 350600, '芗城区', NULL);
INSERT INTO `yh_regions` VALUES (1223, 350603, 350600, '龙文区', NULL);
INSERT INTO `yh_regions` VALUES (1224, 350622, 350600, '云霄县', NULL);
INSERT INTO `yh_regions` VALUES (1225, 350623, 350600, '漳浦县', NULL);
INSERT INTO `yh_regions` VALUES (1226, 350624, 350600, '诏安县', NULL);
INSERT INTO `yh_regions` VALUES (1227, 350625, 350600, '长泰县', NULL);
INSERT INTO `yh_regions` VALUES (1228, 350626, 350600, '东山县', NULL);
INSERT INTO `yh_regions` VALUES (1229, 350627, 350600, '南靖县', NULL);
INSERT INTO `yh_regions` VALUES (1230, 350628, 350600, '平和县', NULL);
INSERT INTO `yh_regions` VALUES (1231, 350629, 350600, '华安县', NULL);
INSERT INTO `yh_regions` VALUES (1232, 350681, 350600, '龙海市', NULL);
INSERT INTO `yh_regions` VALUES (1233, 350702, 350700, '延平区', NULL);
INSERT INTO `yh_regions` VALUES (1234, 350703, 350700, '建阳区', NULL);
INSERT INTO `yh_regions` VALUES (1235, 350721, 350700, '顺昌县', NULL);
INSERT INTO `yh_regions` VALUES (1236, 350722, 350700, '浦城县', NULL);
INSERT INTO `yh_regions` VALUES (1237, 350723, 350700, '光泽县', NULL);
INSERT INTO `yh_regions` VALUES (1238, 350724, 350700, '松溪县', NULL);
INSERT INTO `yh_regions` VALUES (1239, 350725, 350700, '政和县', NULL);
INSERT INTO `yh_regions` VALUES (1240, 350781, 350700, '邵武市', NULL);
INSERT INTO `yh_regions` VALUES (1241, 350782, 350700, '武夷山市', NULL);
INSERT INTO `yh_regions` VALUES (1242, 350783, 350700, '建瓯市', NULL);
INSERT INTO `yh_regions` VALUES (1243, 350802, 350800, '新罗区', NULL);
INSERT INTO `yh_regions` VALUES (1244, 350803, 350800, '永定区', NULL);
INSERT INTO `yh_regions` VALUES (1245, 350821, 350800, '长汀县', NULL);
INSERT INTO `yh_regions` VALUES (1246, 350823, 350800, '上杭县', NULL);
INSERT INTO `yh_regions` VALUES (1247, 350824, 350800, '武平县', NULL);
INSERT INTO `yh_regions` VALUES (1248, 350825, 350800, '连城县', NULL);
INSERT INTO `yh_regions` VALUES (1249, 350881, 350800, '漳平市', NULL);
INSERT INTO `yh_regions` VALUES (1250, 350902, 350900, '蕉城区', NULL);
INSERT INTO `yh_regions` VALUES (1251, 350921, 350900, '霞浦县', NULL);
INSERT INTO `yh_regions` VALUES (1252, 350922, 350900, '古田县', NULL);
INSERT INTO `yh_regions` VALUES (1253, 350923, 350900, '屏南县', NULL);
INSERT INTO `yh_regions` VALUES (1254, 350924, 350900, '寿宁县', NULL);
INSERT INTO `yh_regions` VALUES (1255, 350925, 350900, '周宁县', NULL);
INSERT INTO `yh_regions` VALUES (1256, 350926, 350900, '柘荣县', NULL);
INSERT INTO `yh_regions` VALUES (1257, 350981, 350900, '福安市', NULL);
INSERT INTO `yh_regions` VALUES (1258, 350982, 350900, '福鼎市', NULL);
INSERT INTO `yh_regions` VALUES (1259, 360100, 360000, '南昌市', NULL);
INSERT INTO `yh_regions` VALUES (1260, 360200, 360000, '景德镇市', NULL);
INSERT INTO `yh_regions` VALUES (1261, 360300, 360000, '萍乡市', NULL);
INSERT INTO `yh_regions` VALUES (1262, 360400, 360000, '九江市', NULL);
INSERT INTO `yh_regions` VALUES (1263, 360500, 360000, '新余市', NULL);
INSERT INTO `yh_regions` VALUES (1264, 360600, 360000, '鹰潭市', NULL);
INSERT INTO `yh_regions` VALUES (1265, 360700, 360000, '赣州市', NULL);
INSERT INTO `yh_regions` VALUES (1266, 360800, 360000, '吉安市', NULL);
INSERT INTO `yh_regions` VALUES (1267, 360900, 360000, '宜春市', NULL);
INSERT INTO `yh_regions` VALUES (1268, 361000, 360000, '抚州市', NULL);
INSERT INTO `yh_regions` VALUES (1269, 361100, 360000, '上饶市', NULL);
INSERT INTO `yh_regions` VALUES (1270, 360102, 360100, '东湖区', NULL);
INSERT INTO `yh_regions` VALUES (1271, 360103, 360100, '西湖区', NULL);
INSERT INTO `yh_regions` VALUES (1272, 360104, 360100, '青云谱区', NULL);
INSERT INTO `yh_regions` VALUES (1273, 360105, 360100, '湾里区', NULL);
INSERT INTO `yh_regions` VALUES (1274, 360111, 360100, '青山湖区', NULL);
INSERT INTO `yh_regions` VALUES (1275, 360112, 360100, '新建区', NULL);
INSERT INTO `yh_regions` VALUES (1276, 360121, 360100, '南昌县', NULL);
INSERT INTO `yh_regions` VALUES (1277, 360123, 360100, '安义县', NULL);
INSERT INTO `yh_regions` VALUES (1278, 360124, 360100, '进贤县', NULL);
INSERT INTO `yh_regions` VALUES (1279, 360202, 360200, '昌江区', NULL);
INSERT INTO `yh_regions` VALUES (1280, 360203, 360200, '珠山区', NULL);
INSERT INTO `yh_regions` VALUES (1281, 360222, 360200, '浮梁县', NULL);
INSERT INTO `yh_regions` VALUES (1282, 360281, 360200, '乐平市', NULL);
INSERT INTO `yh_regions` VALUES (1283, 360302, 360300, '安源区', NULL);
INSERT INTO `yh_regions` VALUES (1284, 360313, 360300, '湘东区', NULL);
INSERT INTO `yh_regions` VALUES (1285, 360321, 360300, '莲花县', NULL);
INSERT INTO `yh_regions` VALUES (1286, 360322, 360300, '上栗县', NULL);
INSERT INTO `yh_regions` VALUES (1287, 360323, 360300, '芦溪县', NULL);
INSERT INTO `yh_regions` VALUES (1288, 360402, 360400, '濂溪区', NULL);
INSERT INTO `yh_regions` VALUES (1289, 360403, 360400, '浔阳区', NULL);
INSERT INTO `yh_regions` VALUES (1290, 360404, 360400, '柴桑区', NULL);
INSERT INTO `yh_regions` VALUES (1291, 360423, 360400, '武宁县', NULL);
INSERT INTO `yh_regions` VALUES (1292, 360424, 360400, '修水县', NULL);
INSERT INTO `yh_regions` VALUES (1293, 360425, 360400, '永修县', NULL);
INSERT INTO `yh_regions` VALUES (1294, 360426, 360400, '德安县', NULL);
INSERT INTO `yh_regions` VALUES (1295, 360428, 360400, '都昌县', NULL);
INSERT INTO `yh_regions` VALUES (1296, 360429, 360400, '湖口县', NULL);
INSERT INTO `yh_regions` VALUES (1297, 360430, 360400, '彭泽县', NULL);
INSERT INTO `yh_regions` VALUES (1298, 360481, 360400, '瑞昌市', NULL);
INSERT INTO `yh_regions` VALUES (1299, 360482, 360400, '共青城市', NULL);
INSERT INTO `yh_regions` VALUES (1300, 360483, 360400, '庐山市', NULL);
INSERT INTO `yh_regions` VALUES (1301, 360502, 360500, '渝水区', NULL);
INSERT INTO `yh_regions` VALUES (1302, 360521, 360500, '分宜县', NULL);
INSERT INTO `yh_regions` VALUES (1303, 360602, 360600, '月湖区', NULL);
INSERT INTO `yh_regions` VALUES (1304, 360622, 360600, '余江县', NULL);
INSERT INTO `yh_regions` VALUES (1305, 360681, 360600, '贵溪市', NULL);
INSERT INTO `yh_regions` VALUES (1306, 360702, 360700, '章贡区', NULL);
INSERT INTO `yh_regions` VALUES (1307, 360703, 360700, '南康区', NULL);
INSERT INTO `yh_regions` VALUES (1308, 360704, 360700, '赣县区', NULL);
INSERT INTO `yh_regions` VALUES (1309, 360722, 360700, '信丰县', NULL);
INSERT INTO `yh_regions` VALUES (1310, 360723, 360700, '大余县', NULL);
INSERT INTO `yh_regions` VALUES (1311, 360724, 360700, '上犹县', NULL);
INSERT INTO `yh_regions` VALUES (1312, 360725, 360700, '崇义县', NULL);
INSERT INTO `yh_regions` VALUES (1313, 360726, 360700, '安远县', NULL);
INSERT INTO `yh_regions` VALUES (1314, 360727, 360700, '龙南县', NULL);
INSERT INTO `yh_regions` VALUES (1315, 360728, 360700, '定南县', NULL);
INSERT INTO `yh_regions` VALUES (1316, 360729, 360700, '全南县', NULL);
INSERT INTO `yh_regions` VALUES (1317, 360730, 360700, '宁都县', NULL);
INSERT INTO `yh_regions` VALUES (1318, 360731, 360700, '于都县', NULL);
INSERT INTO `yh_regions` VALUES (1319, 360732, 360700, '兴国县', NULL);
INSERT INTO `yh_regions` VALUES (1320, 360733, 360700, '会昌县', NULL);
INSERT INTO `yh_regions` VALUES (1321, 360734, 360700, '寻乌县', NULL);
INSERT INTO `yh_regions` VALUES (1322, 360735, 360700, '石城县', NULL);
INSERT INTO `yh_regions` VALUES (1323, 360781, 360700, '瑞金市', NULL);
INSERT INTO `yh_regions` VALUES (1324, 360802, 360800, '吉州区', NULL);
INSERT INTO `yh_regions` VALUES (1325, 360803, 360800, '青原区', NULL);
INSERT INTO `yh_regions` VALUES (1326, 360821, 360800, '吉安县', NULL);
INSERT INTO `yh_regions` VALUES (1327, 360822, 360800, '吉水县', NULL);
INSERT INTO `yh_regions` VALUES (1328, 360823, 360800, '峡江县', NULL);
INSERT INTO `yh_regions` VALUES (1329, 360824, 360800, '新干县', NULL);
INSERT INTO `yh_regions` VALUES (1330, 360825, 360800, '永丰县', NULL);
INSERT INTO `yh_regions` VALUES (1331, 360826, 360800, '泰和县', NULL);
INSERT INTO `yh_regions` VALUES (1332, 360827, 360800, '遂川县', NULL);
INSERT INTO `yh_regions` VALUES (1333, 360828, 360800, '万安县', NULL);
INSERT INTO `yh_regions` VALUES (1334, 360829, 360800, '安福县', NULL);
INSERT INTO `yh_regions` VALUES (1335, 360830, 360800, '永新县', NULL);
INSERT INTO `yh_regions` VALUES (1336, 360881, 360800, '井冈山市', NULL);
INSERT INTO `yh_regions` VALUES (1337, 360902, 360900, '袁州区', NULL);
INSERT INTO `yh_regions` VALUES (1338, 360921, 360900, '奉新县', NULL);
INSERT INTO `yh_regions` VALUES (1339, 360922, 360900, '万载县', NULL);
INSERT INTO `yh_regions` VALUES (1340, 360923, 360900, '上高县', NULL);
INSERT INTO `yh_regions` VALUES (1341, 360924, 360900, '宜丰县', NULL);
INSERT INTO `yh_regions` VALUES (1342, 360925, 360900, '靖安县', NULL);
INSERT INTO `yh_regions` VALUES (1343, 360926, 360900, '铜鼓县', NULL);
INSERT INTO `yh_regions` VALUES (1344, 360981, 360900, '丰城市', NULL);
INSERT INTO `yh_regions` VALUES (1345, 360982, 360900, '樟树市', NULL);
INSERT INTO `yh_regions` VALUES (1346, 360983, 360900, '高安市', NULL);
INSERT INTO `yh_regions` VALUES (1347, 361002, 361000, '临川区', NULL);
INSERT INTO `yh_regions` VALUES (1348, 361003, 361000, '东乡区', NULL);
INSERT INTO `yh_regions` VALUES (1349, 361021, 361000, '南城县', NULL);
INSERT INTO `yh_regions` VALUES (1350, 361022, 361000, '黎川县', NULL);
INSERT INTO `yh_regions` VALUES (1351, 361023, 361000, '南丰县', NULL);
INSERT INTO `yh_regions` VALUES (1352, 361024, 361000, '崇仁县', NULL);
INSERT INTO `yh_regions` VALUES (1353, 361025, 361000, '乐安县', NULL);
INSERT INTO `yh_regions` VALUES (1354, 361026, 361000, '宜黄县', NULL);
INSERT INTO `yh_regions` VALUES (1355, 361027, 361000, '金溪县', NULL);
INSERT INTO `yh_regions` VALUES (1356, 361028, 361000, '资溪县', NULL);
INSERT INTO `yh_regions` VALUES (1357, 361030, 361000, '广昌县', NULL);
INSERT INTO `yh_regions` VALUES (1358, 361102, 361100, '信州区', NULL);
INSERT INTO `yh_regions` VALUES (1359, 361103, 361100, '广丰区', NULL);
INSERT INTO `yh_regions` VALUES (1360, 361121, 361100, '广信区', NULL);
INSERT INTO `yh_regions` VALUES (1361, 361123, 361100, '玉山县', NULL);
INSERT INTO `yh_regions` VALUES (1362, 361124, 361100, '铅山县', NULL);
INSERT INTO `yh_regions` VALUES (1363, 361125, 361100, '横峰县', NULL);
INSERT INTO `yh_regions` VALUES (1364, 361126, 361100, '弋阳县', NULL);
INSERT INTO `yh_regions` VALUES (1365, 361127, 361100, '余干县', NULL);
INSERT INTO `yh_regions` VALUES (1366, 361128, 361100, '鄱阳县', NULL);
INSERT INTO `yh_regions` VALUES (1367, 361129, 361100, '万年县', NULL);
INSERT INTO `yh_regions` VALUES (1368, 361130, 361100, '婺源县', NULL);
INSERT INTO `yh_regions` VALUES (1369, 361181, 361100, '德兴市', NULL);
INSERT INTO `yh_regions` VALUES (1370, 370100, 370000, '济南市', NULL);
INSERT INTO `yh_regions` VALUES (1371, 370200, 370000, '青岛市', NULL);
INSERT INTO `yh_regions` VALUES (1372, 370300, 370000, '淄博市', NULL);
INSERT INTO `yh_regions` VALUES (1373, 370400, 370000, '枣庄市', NULL);
INSERT INTO `yh_regions` VALUES (1374, 370500, 370000, '东营市', NULL);
INSERT INTO `yh_regions` VALUES (1375, 370600, 370000, '烟台市', NULL);
INSERT INTO `yh_regions` VALUES (1376, 370700, 370000, '潍坊市', NULL);
INSERT INTO `yh_regions` VALUES (1377, 370800, 370000, '济宁市', NULL);
INSERT INTO `yh_regions` VALUES (1378, 370900, 370000, '泰安市', NULL);
INSERT INTO `yh_regions` VALUES (1379, 371000, 370000, '威海市', NULL);
INSERT INTO `yh_regions` VALUES (1380, 371100, 370000, '日照市', NULL);
INSERT INTO `yh_regions` VALUES (1381, 371200, 370000, '莱芜市', NULL);
INSERT INTO `yh_regions` VALUES (1382, 371300, 370000, '临沂市', NULL);
INSERT INTO `yh_regions` VALUES (1383, 371400, 370000, '德州市', NULL);
INSERT INTO `yh_regions` VALUES (1384, 371500, 370000, '聊城市', NULL);
INSERT INTO `yh_regions` VALUES (1385, 371600, 370000, '滨州市', NULL);
INSERT INTO `yh_regions` VALUES (1386, 371700, 370000, '菏泽市', NULL);
INSERT INTO `yh_regions` VALUES (1387, 370102, 370100, '历下区', NULL);
INSERT INTO `yh_regions` VALUES (1388, 370103, 370100, '市中区', NULL);
INSERT INTO `yh_regions` VALUES (1389, 370104, 370100, '槐荫区', NULL);
INSERT INTO `yh_regions` VALUES (1390, 370105, 370100, '天桥区', NULL);
INSERT INTO `yh_regions` VALUES (1391, 370112, 370100, '历城区', NULL);
INSERT INTO `yh_regions` VALUES (1392, 370113, 370100, '长清区', NULL);
INSERT INTO `yh_regions` VALUES (1393, 370114, 370100, '章丘区', NULL);
INSERT INTO `yh_regions` VALUES (1394, 370124, 370100, '平阴县', NULL);
INSERT INTO `yh_regions` VALUES (1395, 370125, 370100, '济阳县', NULL);
INSERT INTO `yh_regions` VALUES (1396, 370126, 370100, '商河县', NULL);
INSERT INTO `yh_regions` VALUES (1397, 370202, 370200, '市南区', NULL);
INSERT INTO `yh_regions` VALUES (1398, 370203, 370200, '市北区', NULL);
INSERT INTO `yh_regions` VALUES (1399, 370211, 370200, '黄岛区', NULL);
INSERT INTO `yh_regions` VALUES (1400, 370212, 370200, '崂山区', NULL);
INSERT INTO `yh_regions` VALUES (1401, 370213, 370200, '李沧区', NULL);
INSERT INTO `yh_regions` VALUES (1402, 370214, 370200, '城阳区', NULL);
INSERT INTO `yh_regions` VALUES (1403, 370215, 370200, '即墨区', NULL);
INSERT INTO `yh_regions` VALUES (1404, 370281, 370200, '胶州市', NULL);
INSERT INTO `yh_regions` VALUES (1405, 370283, 370200, '平度市', NULL);
INSERT INTO `yh_regions` VALUES (1406, 370285, 370200, '莱西市', NULL);
INSERT INTO `yh_regions` VALUES (1407, 370302, 370300, '淄川区', NULL);
INSERT INTO `yh_regions` VALUES (1408, 370303, 370300, '张店区', NULL);
INSERT INTO `yh_regions` VALUES (1409, 370304, 370300, '博山区', NULL);
INSERT INTO `yh_regions` VALUES (1410, 370305, 370300, '临淄区', NULL);
INSERT INTO `yh_regions` VALUES (1411, 370306, 370300, '周村区', NULL);
INSERT INTO `yh_regions` VALUES (1412, 370321, 370300, '桓台县', NULL);
INSERT INTO `yh_regions` VALUES (1413, 370322, 370300, '高青县', NULL);
INSERT INTO `yh_regions` VALUES (1414, 370323, 370300, '沂源县', NULL);
INSERT INTO `yh_regions` VALUES (1415, 370402, 370400, '市中区', NULL);
INSERT INTO `yh_regions` VALUES (1416, 370403, 370400, '薛城区', NULL);
INSERT INTO `yh_regions` VALUES (1417, 370404, 370400, '峄城区', NULL);
INSERT INTO `yh_regions` VALUES (1418, 370405, 370400, '台儿庄区', NULL);
INSERT INTO `yh_regions` VALUES (1419, 370406, 370400, '山亭区', NULL);
INSERT INTO `yh_regions` VALUES (1420, 370481, 370400, '滕州市', NULL);
INSERT INTO `yh_regions` VALUES (1421, 370502, 370500, '东营区', NULL);
INSERT INTO `yh_regions` VALUES (1422, 370503, 370500, '河口区', NULL);
INSERT INTO `yh_regions` VALUES (1423, 370505, 370500, '垦利区', NULL);
INSERT INTO `yh_regions` VALUES (1424, 370522, 370500, '利津县', NULL);
INSERT INTO `yh_regions` VALUES (1425, 370523, 370500, '广饶县', NULL);
INSERT INTO `yh_regions` VALUES (1426, 370602, 370600, '芝罘区', NULL);
INSERT INTO `yh_regions` VALUES (1427, 370611, 370600, '福山区', NULL);
INSERT INTO `yh_regions` VALUES (1428, 370612, 370600, '牟平区', NULL);
INSERT INTO `yh_regions` VALUES (1429, 370613, 370600, '莱山区', NULL);
INSERT INTO `yh_regions` VALUES (1430, 370634, 370600, '长岛县', NULL);
INSERT INTO `yh_regions` VALUES (1431, 370681, 370600, '龙口市', NULL);
INSERT INTO `yh_regions` VALUES (1432, 370682, 370600, '莱阳市', NULL);
INSERT INTO `yh_regions` VALUES (1433, 370683, 370600, '莱州市', NULL);
INSERT INTO `yh_regions` VALUES (1434, 370684, 370600, '蓬莱市', NULL);
INSERT INTO `yh_regions` VALUES (1435, 370685, 370600, '招远市', NULL);
INSERT INTO `yh_regions` VALUES (1436, 370686, 370600, '栖霞市', NULL);
INSERT INTO `yh_regions` VALUES (1437, 370687, 370600, '海阳市', NULL);
INSERT INTO `yh_regions` VALUES (1438, 370702, 370700, '潍城区', NULL);
INSERT INTO `yh_regions` VALUES (1439, 370703, 370700, '寒亭区', NULL);
INSERT INTO `yh_regions` VALUES (1440, 370704, 370700, '坊子区', NULL);
INSERT INTO `yh_regions` VALUES (1441, 370705, 370700, '奎文区', NULL);
INSERT INTO `yh_regions` VALUES (1442, 370724, 370700, '临朐县', NULL);
INSERT INTO `yh_regions` VALUES (1443, 370725, 370700, '昌乐县', NULL);
INSERT INTO `yh_regions` VALUES (1444, 370781, 370700, '青州市', NULL);
INSERT INTO `yh_regions` VALUES (1445, 370782, 370700, '诸城市', NULL);
INSERT INTO `yh_regions` VALUES (1446, 370783, 370700, '寿光市', NULL);
INSERT INTO `yh_regions` VALUES (1447, 370784, 370700, '安丘市', NULL);
INSERT INTO `yh_regions` VALUES (1448, 370785, 370700, '高密市', NULL);
INSERT INTO `yh_regions` VALUES (1449, 370786, 370700, '昌邑市', NULL);
INSERT INTO `yh_regions` VALUES (1450, 370811, 370800, '任城区', NULL);
INSERT INTO `yh_regions` VALUES (1451, 370812, 370800, '兖州区', NULL);
INSERT INTO `yh_regions` VALUES (1452, 370826, 370800, '微山县', NULL);
INSERT INTO `yh_regions` VALUES (1453, 370827, 370800, '鱼台县', NULL);
INSERT INTO `yh_regions` VALUES (1454, 370828, 370800, '金乡县', NULL);
INSERT INTO `yh_regions` VALUES (1455, 370829, 370800, '嘉祥县', NULL);
INSERT INTO `yh_regions` VALUES (1456, 370830, 370800, '汶上县', NULL);
INSERT INTO `yh_regions` VALUES (1457, 370831, 370800, '泗水县', NULL);
INSERT INTO `yh_regions` VALUES (1458, 370832, 370800, '梁山县', NULL);
INSERT INTO `yh_regions` VALUES (1459, 370881, 370800, '曲阜市', NULL);
INSERT INTO `yh_regions` VALUES (1460, 370883, 370800, '邹城市', NULL);
INSERT INTO `yh_regions` VALUES (1461, 370902, 370900, '泰山区', NULL);
INSERT INTO `yh_regions` VALUES (1462, 370911, 370900, '岱岳区', NULL);
INSERT INTO `yh_regions` VALUES (1463, 370921, 370900, '宁阳县', NULL);
INSERT INTO `yh_regions` VALUES (1464, 370923, 370900, '东平县', NULL);
INSERT INTO `yh_regions` VALUES (1465, 370982, 370900, '新泰市', NULL);
INSERT INTO `yh_regions` VALUES (1466, 370983, 370900, '肥城市', NULL);
INSERT INTO `yh_regions` VALUES (1467, 371002, 371000, '环翠区', NULL);
INSERT INTO `yh_regions` VALUES (1468, 371003, 371000, '文登区', NULL);
INSERT INTO `yh_regions` VALUES (1469, 371082, 371000, '荣成市', NULL);
INSERT INTO `yh_regions` VALUES (1470, 371083, 371000, '乳山市', NULL);
INSERT INTO `yh_regions` VALUES (1471, 371102, 371100, '东港区', NULL);
INSERT INTO `yh_regions` VALUES (1472, 371103, 371100, '岚山区', NULL);
INSERT INTO `yh_regions` VALUES (1473, 371121, 371100, '五莲县', NULL);
INSERT INTO `yh_regions` VALUES (1474, 371122, 371100, '莒县', NULL);
INSERT INTO `yh_regions` VALUES (1475, 371202, 371200, '莱城区', NULL);
INSERT INTO `yh_regions` VALUES (1476, 371203, 371200, '钢城区', NULL);
INSERT INTO `yh_regions` VALUES (1477, 371302, 371300, '兰山区', NULL);
INSERT INTO `yh_regions` VALUES (1478, 371311, 371300, '罗庄区', NULL);
INSERT INTO `yh_regions` VALUES (1479, 371312, 371300, '河东区', NULL);
INSERT INTO `yh_regions` VALUES (1480, 371321, 371300, '沂南县', NULL);
INSERT INTO `yh_regions` VALUES (1481, 371322, 371300, '郯城县', NULL);
INSERT INTO `yh_regions` VALUES (1482, 371323, 371300, '沂水县', NULL);
INSERT INTO `yh_regions` VALUES (1483, 371324, 371300, '兰陵县', NULL);
INSERT INTO `yh_regions` VALUES (1484, 371325, 371300, '费县', NULL);
INSERT INTO `yh_regions` VALUES (1485, 371326, 371300, '平邑县', NULL);
INSERT INTO `yh_regions` VALUES (1486, 371327, 371300, '莒南县', NULL);
INSERT INTO `yh_regions` VALUES (1487, 371328, 371300, '蒙阴县', NULL);
INSERT INTO `yh_regions` VALUES (1488, 371329, 371300, '临沭县', NULL);
INSERT INTO `yh_regions` VALUES (1489, 371402, 371400, '德城区', NULL);
INSERT INTO `yh_regions` VALUES (1490, 371403, 371400, '陵城区', NULL);
INSERT INTO `yh_regions` VALUES (1491, 371422, 371400, '宁津县', NULL);
INSERT INTO `yh_regions` VALUES (1492, 371423, 371400, '庆云县', NULL);
INSERT INTO `yh_regions` VALUES (1493, 371424, 371400, '临邑县', NULL);
INSERT INTO `yh_regions` VALUES (1494, 371425, 371400, '齐河县', NULL);
INSERT INTO `yh_regions` VALUES (1495, 371426, 371400, '平原县', NULL);
INSERT INTO `yh_regions` VALUES (1496, 371427, 371400, '夏津县', NULL);
INSERT INTO `yh_regions` VALUES (1497, 371428, 371400, '武城县', NULL);
INSERT INTO `yh_regions` VALUES (1498, 371481, 371400, '乐陵市', NULL);
INSERT INTO `yh_regions` VALUES (1499, 371482, 371400, '禹城市', NULL);
INSERT INTO `yh_regions` VALUES (1500, 371502, 371500, '东昌府区', NULL);
INSERT INTO `yh_regions` VALUES (1501, 371521, 371500, '阳谷县', NULL);
INSERT INTO `yh_regions` VALUES (1502, 371522, 371500, '莘县', NULL);
INSERT INTO `yh_regions` VALUES (1503, 371523, 371500, '茌平县', NULL);
INSERT INTO `yh_regions` VALUES (1504, 371524, 371500, '东阿县', NULL);
INSERT INTO `yh_regions` VALUES (1505, 371525, 371500, '冠县', NULL);
INSERT INTO `yh_regions` VALUES (1506, 371526, 371500, '高唐县', NULL);
INSERT INTO `yh_regions` VALUES (1507, 371581, 371500, '临清市', NULL);
INSERT INTO `yh_regions` VALUES (1508, 371602, 371600, '滨城区', NULL);
INSERT INTO `yh_regions` VALUES (1509, 371603, 371600, '沾化区', NULL);
INSERT INTO `yh_regions` VALUES (1510, 371621, 371600, '惠民县', NULL);
INSERT INTO `yh_regions` VALUES (1511, 371622, 371600, '阳信县', NULL);
INSERT INTO `yh_regions` VALUES (1512, 371623, 371600, '无棣县', NULL);
INSERT INTO `yh_regions` VALUES (1513, 371625, 371600, '博兴县', NULL);
INSERT INTO `yh_regions` VALUES (1514, 371626, 371600, '邹平县', NULL);
INSERT INTO `yh_regions` VALUES (1515, 371702, 371700, '牡丹区', NULL);
INSERT INTO `yh_regions` VALUES (1516, 371703, 371700, '定陶区', NULL);
INSERT INTO `yh_regions` VALUES (1517, 371721, 371700, '曹县', NULL);
INSERT INTO `yh_regions` VALUES (1518, 371722, 371700, '单县', NULL);
INSERT INTO `yh_regions` VALUES (1519, 371723, 371700, '成武县', NULL);
INSERT INTO `yh_regions` VALUES (1520, 371724, 371700, '巨野县', NULL);
INSERT INTO `yh_regions` VALUES (1521, 371725, 371700, '郓城县', NULL);
INSERT INTO `yh_regions` VALUES (1522, 371726, 371700, '鄄城县', NULL);
INSERT INTO `yh_regions` VALUES (1523, 371728, 371700, '东明县', NULL);
INSERT INTO `yh_regions` VALUES (1524, 410100, 410000, '郑州市', NULL);
INSERT INTO `yh_regions` VALUES (1525, 410200, 410000, '开封市', NULL);
INSERT INTO `yh_regions` VALUES (1526, 410300, 410000, '洛阳市', NULL);
INSERT INTO `yh_regions` VALUES (1527, 410400, 410000, '平顶山市', NULL);
INSERT INTO `yh_regions` VALUES (1528, 410500, 410000, '安阳市', NULL);
INSERT INTO `yh_regions` VALUES (1529, 410600, 410000, '鹤壁市', NULL);
INSERT INTO `yh_regions` VALUES (1530, 410700, 410000, '新乡市', NULL);
INSERT INTO `yh_regions` VALUES (1531, 410800, 410000, '焦作市', NULL);
INSERT INTO `yh_regions` VALUES (1532, 410900, 410000, '濮阳市', NULL);
INSERT INTO `yh_regions` VALUES (1533, 411000, 410000, '许昌市', NULL);
INSERT INTO `yh_regions` VALUES (1534, 411100, 410000, '漯河市', NULL);
INSERT INTO `yh_regions` VALUES (1535, 411200, 410000, '三门峡市', NULL);
INSERT INTO `yh_regions` VALUES (1536, 411300, 410000, '南阳市', NULL);
INSERT INTO `yh_regions` VALUES (1537, 411400, 410000, '商丘市', NULL);
INSERT INTO `yh_regions` VALUES (1538, 411500, 410000, '信阳市', NULL);
INSERT INTO `yh_regions` VALUES (1539, 411600, 410000, '周口市', NULL);
INSERT INTO `yh_regions` VALUES (1540, 411700, 410000, '驻马店市', NULL);
INSERT INTO `yh_regions` VALUES (1541, 419001, 410000, '济源市', NULL);
INSERT INTO `yh_regions` VALUES (1542, 410102, 410100, '中原区', NULL);
INSERT INTO `yh_regions` VALUES (1543, 410103, 410100, '二七区', NULL);
INSERT INTO `yh_regions` VALUES (1544, 410104, 410100, '管城回族区', NULL);
INSERT INTO `yh_regions` VALUES (1545, 410105, 410100, '金水区', NULL);
INSERT INTO `yh_regions` VALUES (1546, 410106, 410100, '上街区', NULL);
INSERT INTO `yh_regions` VALUES (1547, 410108, 410100, '惠济区', NULL);
INSERT INTO `yh_regions` VALUES (1548, 410122, 410100, '中牟县', NULL);
INSERT INTO `yh_regions` VALUES (1549, 410181, 410100, '巩义市', NULL);
INSERT INTO `yh_regions` VALUES (1550, 410182, 410100, '荥阳市', NULL);
INSERT INTO `yh_regions` VALUES (1551, 410183, 410100, '新密市', NULL);
INSERT INTO `yh_regions` VALUES (1552, 410184, 410100, '新郑市', NULL);
INSERT INTO `yh_regions` VALUES (1553, 410185, 410100, '登封市', NULL);
INSERT INTO `yh_regions` VALUES (1554, 410202, 410200, '龙亭区', NULL);
INSERT INTO `yh_regions` VALUES (1555, 410203, 410200, '顺河回族区', NULL);
INSERT INTO `yh_regions` VALUES (1556, 410204, 410200, '鼓楼区', NULL);
INSERT INTO `yh_regions` VALUES (1557, 410205, 410200, '禹王台区', NULL);
INSERT INTO `yh_regions` VALUES (1558, 410212, 410200, '祥符区', NULL);
INSERT INTO `yh_regions` VALUES (1559, 410221, 410200, '杞县', NULL);
INSERT INTO `yh_regions` VALUES (1560, 410222, 410200, '通许县', NULL);
INSERT INTO `yh_regions` VALUES (1561, 410223, 410200, '尉氏县', NULL);
INSERT INTO `yh_regions` VALUES (1562, 410225, 410200, '兰考县', NULL);
INSERT INTO `yh_regions` VALUES (1563, 410302, 410300, '老城区', NULL);
INSERT INTO `yh_regions` VALUES (1564, 410303, 410300, '西工区', NULL);
INSERT INTO `yh_regions` VALUES (1565, 410304, 410300, '瀍河回族区', NULL);
INSERT INTO `yh_regions` VALUES (1566, 410305, 410300, '涧西区', NULL);
INSERT INTO `yh_regions` VALUES (1567, 410306, 410300, '吉利区', NULL);
INSERT INTO `yh_regions` VALUES (1568, 410311, 410300, '洛龙区', NULL);
INSERT INTO `yh_regions` VALUES (1569, 410322, 410300, '孟津县', NULL);
INSERT INTO `yh_regions` VALUES (1570, 410323, 410300, '新安县', NULL);
INSERT INTO `yh_regions` VALUES (1571, 410324, 410300, '栾川县', NULL);
INSERT INTO `yh_regions` VALUES (1572, 410325, 410300, '嵩县', NULL);
INSERT INTO `yh_regions` VALUES (1573, 410326, 410300, '汝阳县', NULL);
INSERT INTO `yh_regions` VALUES (1574, 410327, 410300, '宜阳县', NULL);
INSERT INTO `yh_regions` VALUES (1575, 410328, 410300, '洛宁县', NULL);
INSERT INTO `yh_regions` VALUES (1576, 410329, 410300, '伊川县', NULL);
INSERT INTO `yh_regions` VALUES (1577, 410381, 410300, '偃师市', NULL);
INSERT INTO `yh_regions` VALUES (1578, 410402, 410400, '新华区', NULL);
INSERT INTO `yh_regions` VALUES (1579, 410403, 410400, '卫东区', NULL);
INSERT INTO `yh_regions` VALUES (1580, 410404, 410400, '石龙区', NULL);
INSERT INTO `yh_regions` VALUES (1581, 410411, 410400, '湛河区', NULL);
INSERT INTO `yh_regions` VALUES (1582, 410421, 410400, '宝丰县', NULL);
INSERT INTO `yh_regions` VALUES (1583, 410422, 410400, '叶县', NULL);
INSERT INTO `yh_regions` VALUES (1584, 410423, 410400, '鲁山县', NULL);
INSERT INTO `yh_regions` VALUES (1585, 410425, 410400, '郏县', NULL);
INSERT INTO `yh_regions` VALUES (1586, 410481, 410400, '舞钢市', NULL);
INSERT INTO `yh_regions` VALUES (1587, 410482, 410400, '汝州市', NULL);
INSERT INTO `yh_regions` VALUES (1588, 410502, 410500, '文峰区', NULL);
INSERT INTO `yh_regions` VALUES (1589, 410503, 410500, '北关区', NULL);
INSERT INTO `yh_regions` VALUES (1590, 410505, 410500, '殷都区', NULL);
INSERT INTO `yh_regions` VALUES (1591, 410506, 410500, '龙安区', NULL);
INSERT INTO `yh_regions` VALUES (1592, 410522, 410500, '安阳县', NULL);
INSERT INTO `yh_regions` VALUES (1593, 410523, 410500, '汤阴县', NULL);
INSERT INTO `yh_regions` VALUES (1594, 410526, 410500, '滑县', NULL);
INSERT INTO `yh_regions` VALUES (1595, 410527, 410500, '内黄县', NULL);
INSERT INTO `yh_regions` VALUES (1596, 410581, 410500, '林州市', NULL);
INSERT INTO `yh_regions` VALUES (1597, 410602, 410600, '鹤山区', NULL);
INSERT INTO `yh_regions` VALUES (1598, 410603, 410600, '山城区', NULL);
INSERT INTO `yh_regions` VALUES (1599, 410611, 410600, '淇滨区', NULL);
INSERT INTO `yh_regions` VALUES (1600, 410621, 410600, '浚县', NULL);
INSERT INTO `yh_regions` VALUES (1601, 410622, 410600, '淇县', NULL);
INSERT INTO `yh_regions` VALUES (1602, 410702, 410700, '红旗区', NULL);
INSERT INTO `yh_regions` VALUES (1603, 410703, 410700, '卫滨区', NULL);
INSERT INTO `yh_regions` VALUES (1604, 410704, 410700, '凤泉区', NULL);
INSERT INTO `yh_regions` VALUES (1605, 410711, 410700, '牧野区', NULL);
INSERT INTO `yh_regions` VALUES (1606, 410721, 410700, '新乡县', NULL);
INSERT INTO `yh_regions` VALUES (1607, 410724, 410700, '获嘉县', NULL);
INSERT INTO `yh_regions` VALUES (1608, 410725, 410700, '原阳县', NULL);
INSERT INTO `yh_regions` VALUES (1609, 410726, 410700, '延津县', NULL);
INSERT INTO `yh_regions` VALUES (1610, 410727, 410700, '封丘县', NULL);
INSERT INTO `yh_regions` VALUES (1611, 410728, 410700, '长垣县', NULL);
INSERT INTO `yh_regions` VALUES (1612, 410781, 410700, '卫辉市', NULL);
INSERT INTO `yh_regions` VALUES (1613, 410782, 410700, '辉县市', NULL);
INSERT INTO `yh_regions` VALUES (1614, 410802, 410800, '解放区', NULL);
INSERT INTO `yh_regions` VALUES (1615, 410803, 410800, '中站区', NULL);
INSERT INTO `yh_regions` VALUES (1616, 410804, 410800, '马村区', NULL);
INSERT INTO `yh_regions` VALUES (1617, 410811, 410800, '山阳区', NULL);
INSERT INTO `yh_regions` VALUES (1618, 410821, 410800, '修武县', NULL);
INSERT INTO `yh_regions` VALUES (1619, 410822, 410800, '博爱县', NULL);
INSERT INTO `yh_regions` VALUES (1620, 410823, 410800, '武陟县', NULL);
INSERT INTO `yh_regions` VALUES (1621, 410825, 410800, '温县', NULL);
INSERT INTO `yh_regions` VALUES (1622, 410882, 410800, '沁阳市', NULL);
INSERT INTO `yh_regions` VALUES (1623, 410883, 410800, '孟州市', NULL);
INSERT INTO `yh_regions` VALUES (1624, 410902, 410900, '华龙区', NULL);
INSERT INTO `yh_regions` VALUES (1625, 410922, 410900, '清丰县', NULL);
INSERT INTO `yh_regions` VALUES (1626, 410923, 410900, '南乐县', NULL);
INSERT INTO `yh_regions` VALUES (1627, 410926, 410900, '范县', NULL);
INSERT INTO `yh_regions` VALUES (1628, 410927, 410900, '台前县', NULL);
INSERT INTO `yh_regions` VALUES (1629, 410928, 410900, '濮阳县', NULL);
INSERT INTO `yh_regions` VALUES (1630, 411002, 411000, '魏都区', NULL);
INSERT INTO `yh_regions` VALUES (1631, 411003, 411000, '建安区', NULL);
INSERT INTO `yh_regions` VALUES (1632, 411024, 411000, '鄢陵县', NULL);
INSERT INTO `yh_regions` VALUES (1633, 411025, 411000, '襄城县', NULL);
INSERT INTO `yh_regions` VALUES (1634, 411081, 411000, '禹州市', NULL);
INSERT INTO `yh_regions` VALUES (1635, 411082, 411000, '长葛市', NULL);
INSERT INTO `yh_regions` VALUES (1636, 411102, 411100, '源汇区', NULL);
INSERT INTO `yh_regions` VALUES (1637, 411103, 411100, '郾城区', NULL);
INSERT INTO `yh_regions` VALUES (1638, 411104, 411100, '召陵区', NULL);
INSERT INTO `yh_regions` VALUES (1639, 411121, 411100, '舞阳县', NULL);
INSERT INTO `yh_regions` VALUES (1640, 411122, 411100, '临颍县', NULL);
INSERT INTO `yh_regions` VALUES (1641, 411202, 411200, '湖滨区', NULL);
INSERT INTO `yh_regions` VALUES (1642, 411203, 411200, '陕州区', NULL);
INSERT INTO `yh_regions` VALUES (1643, 411221, 411200, '渑池县', NULL);
INSERT INTO `yh_regions` VALUES (1644, 411224, 411200, '卢氏县', NULL);
INSERT INTO `yh_regions` VALUES (1645, 411281, 411200, '义马市', NULL);
INSERT INTO `yh_regions` VALUES (1646, 411282, 411200, '灵宝市', NULL);
INSERT INTO `yh_regions` VALUES (1647, 411302, 411300, '宛城区', NULL);
INSERT INTO `yh_regions` VALUES (1648, 411303, 411300, '卧龙区', NULL);
INSERT INTO `yh_regions` VALUES (1649, 411321, 411300, '南召县', NULL);
INSERT INTO `yh_regions` VALUES (1650, 411322, 411300, '方城县', NULL);
INSERT INTO `yh_regions` VALUES (1651, 411323, 411300, '西峡县', NULL);
INSERT INTO `yh_regions` VALUES (1652, 411324, 411300, '镇平县', NULL);
INSERT INTO `yh_regions` VALUES (1653, 411325, 411300, '内乡县', NULL);
INSERT INTO `yh_regions` VALUES (1654, 411326, 411300, '淅川县', NULL);
INSERT INTO `yh_regions` VALUES (1655, 411327, 411300, '社旗县', NULL);
INSERT INTO `yh_regions` VALUES (1656, 411328, 411300, '唐河县', NULL);
INSERT INTO `yh_regions` VALUES (1657, 411329, 411300, '新野县', NULL);
INSERT INTO `yh_regions` VALUES (1658, 411330, 411300, '桐柏县', NULL);
INSERT INTO `yh_regions` VALUES (1659, 411381, 411300, '邓州市', NULL);
INSERT INTO `yh_regions` VALUES (1660, 411402, 411400, '梁园区', NULL);
INSERT INTO `yh_regions` VALUES (1661, 411403, 411400, '睢阳区', NULL);
INSERT INTO `yh_regions` VALUES (1662, 411421, 411400, '民权县', NULL);
INSERT INTO `yh_regions` VALUES (1663, 411422, 411400, '睢县', NULL);
INSERT INTO `yh_regions` VALUES (1664, 411423, 411400, '宁陵县', NULL);
INSERT INTO `yh_regions` VALUES (1665, 411424, 411400, '柘城县', NULL);
INSERT INTO `yh_regions` VALUES (1666, 411425, 411400, '虞城县', NULL);
INSERT INTO `yh_regions` VALUES (1667, 411426, 411400, '夏邑县', NULL);
INSERT INTO `yh_regions` VALUES (1668, 411481, 411400, '永城市', NULL);
INSERT INTO `yh_regions` VALUES (1669, 411502, 411500, '浉河区', NULL);
INSERT INTO `yh_regions` VALUES (1670, 411503, 411500, '平桥区', NULL);
INSERT INTO `yh_regions` VALUES (1671, 411521, 411500, '罗山县', NULL);
INSERT INTO `yh_regions` VALUES (1672, 411522, 411500, '光山县', NULL);
INSERT INTO `yh_regions` VALUES (1673, 411523, 411500, '新县', NULL);
INSERT INTO `yh_regions` VALUES (1674, 411524, 411500, '商城县', NULL);
INSERT INTO `yh_regions` VALUES (1675, 411525, 411500, '固始县', NULL);
INSERT INTO `yh_regions` VALUES (1676, 411526, 411500, '潢川县', NULL);
INSERT INTO `yh_regions` VALUES (1677, 411527, 411500, '淮滨县', NULL);
INSERT INTO `yh_regions` VALUES (1678, 411528, 411500, '息县', NULL);
INSERT INTO `yh_regions` VALUES (1679, 411602, 411600, '川汇区', NULL);
INSERT INTO `yh_regions` VALUES (1680, 411621, 411600, '扶沟县', NULL);
INSERT INTO `yh_regions` VALUES (1681, 411622, 411600, '西华县', NULL);
INSERT INTO `yh_regions` VALUES (1682, 411623, 411600, '商水县', NULL);
INSERT INTO `yh_regions` VALUES (1683, 411624, 411600, '沈丘县', NULL);
INSERT INTO `yh_regions` VALUES (1684, 411625, 411600, '郸城县', NULL);
INSERT INTO `yh_regions` VALUES (1685, 411626, 411600, '淮阳县', NULL);
INSERT INTO `yh_regions` VALUES (1686, 411627, 411600, '太康县', NULL);
INSERT INTO `yh_regions` VALUES (1687, 411628, 411600, '鹿邑县', NULL);
INSERT INTO `yh_regions` VALUES (1688, 411681, 411600, '项城市', NULL);
INSERT INTO `yh_regions` VALUES (1689, 411702, 411700, '驿城区', NULL);
INSERT INTO `yh_regions` VALUES (1690, 411721, 411700, '西平县', NULL);
INSERT INTO `yh_regions` VALUES (1691, 411722, 411700, '上蔡县', NULL);
INSERT INTO `yh_regions` VALUES (1692, 411723, 411700, '平舆县', NULL);
INSERT INTO `yh_regions` VALUES (1693, 411724, 411700, '正阳县', NULL);
INSERT INTO `yh_regions` VALUES (1694, 411725, 411700, '确山县', NULL);
INSERT INTO `yh_regions` VALUES (1695, 411726, 411700, '泌阳县', NULL);
INSERT INTO `yh_regions` VALUES (1696, 411727, 411700, '汝南县', NULL);
INSERT INTO `yh_regions` VALUES (1697, 411728, 411700, '遂平县', NULL);
INSERT INTO `yh_regions` VALUES (1698, 411729, 411700, '新蔡县', NULL);
INSERT INTO `yh_regions` VALUES (1699, 419001, 419001, '济源市', NULL);
INSERT INTO `yh_regions` VALUES (1700, 420100, 420000, '武汉市', NULL);
INSERT INTO `yh_regions` VALUES (1701, 420200, 420000, '黄石市', NULL);
INSERT INTO `yh_regions` VALUES (1702, 420300, 420000, '十堰市', NULL);
INSERT INTO `yh_regions` VALUES (1703, 420500, 420000, '宜昌市', NULL);
INSERT INTO `yh_regions` VALUES (1704, 420600, 420000, '襄阳市', NULL);
INSERT INTO `yh_regions` VALUES (1705, 420700, 420000, '鄂州市', NULL);
INSERT INTO `yh_regions` VALUES (1706, 420800, 420000, '荆门市', NULL);
INSERT INTO `yh_regions` VALUES (1707, 420900, 420000, '孝感市', NULL);
INSERT INTO `yh_regions` VALUES (1708, 421000, 420000, '荆州市', NULL);
INSERT INTO `yh_regions` VALUES (1709, 421100, 420000, '黄冈市', NULL);
INSERT INTO `yh_regions` VALUES (1710, 421200, 420000, '咸宁市', NULL);
INSERT INTO `yh_regions` VALUES (1711, 421300, 420000, '随州市', NULL);
INSERT INTO `yh_regions` VALUES (1712, 422800, 420000, '恩施土家族苗族自治州', NULL);
INSERT INTO `yh_regions` VALUES (1713, 429004, 420000, '仙桃市', NULL);
INSERT INTO `yh_regions` VALUES (1714, 429005, 420000, '潜江市', NULL);
INSERT INTO `yh_regions` VALUES (1715, 429006, 420000, '天门市', NULL);
INSERT INTO `yh_regions` VALUES (1716, 429021, 420000, '神农架林区', NULL);
INSERT INTO `yh_regions` VALUES (1717, 420102, 420100, '江岸区', NULL);
INSERT INTO `yh_regions` VALUES (1718, 420103, 420100, '江汉区', NULL);
INSERT INTO `yh_regions` VALUES (1719, 420104, 420100, '硚口区', NULL);
INSERT INTO `yh_regions` VALUES (1720, 420105, 420100, '汉阳区', NULL);
INSERT INTO `yh_regions` VALUES (1721, 420106, 420100, '武昌区', NULL);
INSERT INTO `yh_regions` VALUES (1722, 420107, 420100, '青山区', NULL);
INSERT INTO `yh_regions` VALUES (1723, 420111, 420100, '洪山区', NULL);
INSERT INTO `yh_regions` VALUES (1724, 420112, 420100, '东西湖区', NULL);
INSERT INTO `yh_regions` VALUES (1725, 420113, 420100, '汉南区', NULL);
INSERT INTO `yh_regions` VALUES (1726, 420114, 420100, '蔡甸区', NULL);
INSERT INTO `yh_regions` VALUES (1727, 420115, 420100, '江夏区', NULL);
INSERT INTO `yh_regions` VALUES (1728, 420116, 420100, '黄陂区', NULL);
INSERT INTO `yh_regions` VALUES (1729, 420117, 420100, '新洲区', NULL);
INSERT INTO `yh_regions` VALUES (1730, 420202, 420200, '黄石港区', NULL);
INSERT INTO `yh_regions` VALUES (1731, 420203, 420200, '西塞山区', NULL);
INSERT INTO `yh_regions` VALUES (1732, 420204, 420200, '下陆区', NULL);
INSERT INTO `yh_regions` VALUES (1733, 420205, 420200, '铁山区', NULL);
INSERT INTO `yh_regions` VALUES (1734, 420222, 420200, '阳新县', NULL);
INSERT INTO `yh_regions` VALUES (1735, 420281, 420200, '大冶市', NULL);
INSERT INTO `yh_regions` VALUES (1736, 420302, 420300, '茅箭区', NULL);
INSERT INTO `yh_regions` VALUES (1737, 420303, 420300, '张湾区', NULL);
INSERT INTO `yh_regions` VALUES (1738, 420304, 420300, '郧阳区', NULL);
INSERT INTO `yh_regions` VALUES (1739, 420322, 420300, '郧西县', NULL);
INSERT INTO `yh_regions` VALUES (1740, 420323, 420300, '竹山县', NULL);
INSERT INTO `yh_regions` VALUES (1741, 420324, 420300, '竹溪县', NULL);
INSERT INTO `yh_regions` VALUES (1742, 420325, 420300, '房县', NULL);
INSERT INTO `yh_regions` VALUES (1743, 420381, 420300, '丹江口市', NULL);
INSERT INTO `yh_regions` VALUES (1744, 420502, 420500, '西陵区', NULL);
INSERT INTO `yh_regions` VALUES (1745, 420503, 420500, '伍家岗区', NULL);
INSERT INTO `yh_regions` VALUES (1746, 420504, 420500, '点军区', NULL);
INSERT INTO `yh_regions` VALUES (1747, 420505, 420500, '猇亭区', NULL);
INSERT INTO `yh_regions` VALUES (1748, 420506, 420500, '夷陵区', NULL);
INSERT INTO `yh_regions` VALUES (1749, 420525, 420500, '远安县', NULL);
INSERT INTO `yh_regions` VALUES (1750, 420526, 420500, '兴山县', NULL);
INSERT INTO `yh_regions` VALUES (1751, 420527, 420500, '秭归县', NULL);
INSERT INTO `yh_regions` VALUES (1752, 420528, 420500, '长阳土家族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1753, 420529, 420500, '五峰土家族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1754, 420581, 420500, '宜都市', NULL);
INSERT INTO `yh_regions` VALUES (1755, 420582, 420500, '当阳市', NULL);
INSERT INTO `yh_regions` VALUES (1756, 420583, 420500, '枝江市', NULL);
INSERT INTO `yh_regions` VALUES (1757, 420602, 420600, '襄城区', NULL);
INSERT INTO `yh_regions` VALUES (1758, 420606, 420600, '樊城区', NULL);
INSERT INTO `yh_regions` VALUES (1759, 420607, 420600, '襄州区', NULL);
INSERT INTO `yh_regions` VALUES (1760, 420624, 420600, '南漳县', NULL);
INSERT INTO `yh_regions` VALUES (1761, 420625, 420600, '谷城县', NULL);
INSERT INTO `yh_regions` VALUES (1762, 420626, 420600, '保康县', NULL);
INSERT INTO `yh_regions` VALUES (1763, 420682, 420600, '老河口市', NULL);
INSERT INTO `yh_regions` VALUES (1764, 420683, 420600, '枣阳市', NULL);
INSERT INTO `yh_regions` VALUES (1765, 420684, 420600, '宜城市', NULL);
INSERT INTO `yh_regions` VALUES (1766, 420702, 420700, '梁子湖区', NULL);
INSERT INTO `yh_regions` VALUES (1767, 420703, 420700, '华容区', NULL);
INSERT INTO `yh_regions` VALUES (1768, 420704, 420700, '鄂城区', NULL);
INSERT INTO `yh_regions` VALUES (1769, 420802, 420800, '东宝区', NULL);
INSERT INTO `yh_regions` VALUES (1770, 420804, 420800, '掇刀区', NULL);
INSERT INTO `yh_regions` VALUES (1771, 420821, 420800, '京山县', NULL);
INSERT INTO `yh_regions` VALUES (1772, 420822, 420800, '沙洋县', NULL);
INSERT INTO `yh_regions` VALUES (1773, 420881, 420800, '钟祥市', NULL);
INSERT INTO `yh_regions` VALUES (1774, 420902, 420900, '孝南区', NULL);
INSERT INTO `yh_regions` VALUES (1775, 420921, 420900, '孝昌县', NULL);
INSERT INTO `yh_regions` VALUES (1776, 420922, 420900, '大悟县', NULL);
INSERT INTO `yh_regions` VALUES (1777, 420923, 420900, '云梦县', NULL);
INSERT INTO `yh_regions` VALUES (1778, 420981, 420900, '应城市', NULL);
INSERT INTO `yh_regions` VALUES (1779, 420982, 420900, '安陆市', NULL);
INSERT INTO `yh_regions` VALUES (1780, 420984, 420900, '汉川市', NULL);
INSERT INTO `yh_regions` VALUES (1781, 421002, 421000, '沙市区', NULL);
INSERT INTO `yh_regions` VALUES (1782, 421003, 421000, '荆州区', NULL);
INSERT INTO `yh_regions` VALUES (1783, 421022, 421000, '公安县', NULL);
INSERT INTO `yh_regions` VALUES (1784, 421023, 421000, '监利县', NULL);
INSERT INTO `yh_regions` VALUES (1785, 421024, 421000, '江陵县', NULL);
INSERT INTO `yh_regions` VALUES (1786, 421081, 421000, '石首市', NULL);
INSERT INTO `yh_regions` VALUES (1787, 421083, 421000, '洪湖市', NULL);
INSERT INTO `yh_regions` VALUES (1788, 421087, 421000, '松滋市', NULL);
INSERT INTO `yh_regions` VALUES (1789, 421102, 421100, '黄州区', NULL);
INSERT INTO `yh_regions` VALUES (1790, 421121, 421100, '团风县', NULL);
INSERT INTO `yh_regions` VALUES (1791, 421122, 421100, '红安县', NULL);
INSERT INTO `yh_regions` VALUES (1792, 421123, 421100, '罗田县', NULL);
INSERT INTO `yh_regions` VALUES (1793, 421124, 421100, '英山县', NULL);
INSERT INTO `yh_regions` VALUES (1794, 421125, 421100, '浠水县', NULL);
INSERT INTO `yh_regions` VALUES (1795, 421126, 421100, '蕲春县', NULL);
INSERT INTO `yh_regions` VALUES (1796, 421127, 421100, '黄梅县', NULL);
INSERT INTO `yh_regions` VALUES (1797, 421181, 421100, '麻城市', NULL);
INSERT INTO `yh_regions` VALUES (1798, 421182, 421100, '武穴市', NULL);
INSERT INTO `yh_regions` VALUES (1799, 421202, 421200, '咸安区', NULL);
INSERT INTO `yh_regions` VALUES (1800, 421221, 421200, '嘉鱼县', NULL);
INSERT INTO `yh_regions` VALUES (1801, 421222, 421200, '通城县', NULL);
INSERT INTO `yh_regions` VALUES (1802, 421223, 421200, '崇阳县', NULL);
INSERT INTO `yh_regions` VALUES (1803, 421224, 421200, '通山县', NULL);
INSERT INTO `yh_regions` VALUES (1804, 421281, 421200, '赤壁市', NULL);
INSERT INTO `yh_regions` VALUES (1805, 421303, 421300, '曾都区', NULL);
INSERT INTO `yh_regions` VALUES (1806, 421321, 421300, '随县', NULL);
INSERT INTO `yh_regions` VALUES (1807, 421381, 421300, '广水市', NULL);
INSERT INTO `yh_regions` VALUES (1808, 422801, 422800, '恩施市', NULL);
INSERT INTO `yh_regions` VALUES (1809, 422802, 422800, '利川市', NULL);
INSERT INTO `yh_regions` VALUES (1810, 422822, 422800, '建始县', NULL);
INSERT INTO `yh_regions` VALUES (1811, 422823, 422800, '巴东县', NULL);
INSERT INTO `yh_regions` VALUES (1812, 422825, 422800, '宣恩县', NULL);
INSERT INTO `yh_regions` VALUES (1813, 422826, 422800, '咸丰县', NULL);
INSERT INTO `yh_regions` VALUES (1814, 422827, 422800, '来凤县', NULL);
INSERT INTO `yh_regions` VALUES (1815, 422828, 422800, '鹤峰县', NULL);
INSERT INTO `yh_regions` VALUES (1816, 429004, 429004, '仙桃市', NULL);
INSERT INTO `yh_regions` VALUES (1817, 429005, 429005, '潜江市', NULL);
INSERT INTO `yh_regions` VALUES (1818, 429006, 429006, '天门市', NULL);
INSERT INTO `yh_regions` VALUES (1819, 429021, 429021, '神农架林区', NULL);
INSERT INTO `yh_regions` VALUES (1820, 430100, 430000, '长沙市', NULL);
INSERT INTO `yh_regions` VALUES (1821, 430200, 430000, '株洲市', NULL);
INSERT INTO `yh_regions` VALUES (1822, 430300, 430000, '湘潭市', NULL);
INSERT INTO `yh_regions` VALUES (1823, 430400, 430000, '衡阳市', NULL);
INSERT INTO `yh_regions` VALUES (1824, 430500, 430000, '邵阳市', NULL);
INSERT INTO `yh_regions` VALUES (1825, 430600, 430000, '岳阳市', NULL);
INSERT INTO `yh_regions` VALUES (1826, 430700, 430000, '常德市', NULL);
INSERT INTO `yh_regions` VALUES (1827, 430800, 430000, '张家界市', NULL);
INSERT INTO `yh_regions` VALUES (1828, 430900, 430000, '益阳市', NULL);
INSERT INTO `yh_regions` VALUES (1829, 431000, 430000, '郴州市', NULL);
INSERT INTO `yh_regions` VALUES (1830, 431100, 430000, '永州市', NULL);
INSERT INTO `yh_regions` VALUES (1831, 431200, 430000, '怀化市', NULL);
INSERT INTO `yh_regions` VALUES (1832, 431300, 430000, '娄底市', NULL);
INSERT INTO `yh_regions` VALUES (1833, 433100, 430000, '湘西土家族苗族自治州', NULL);
INSERT INTO `yh_regions` VALUES (1834, 430102, 430100, '芙蓉区', NULL);
INSERT INTO `yh_regions` VALUES (1835, 430103, 430100, '天心区', NULL);
INSERT INTO `yh_regions` VALUES (1836, 430104, 430100, '岳麓区', NULL);
INSERT INTO `yh_regions` VALUES (1837, 430105, 430100, '开福区', NULL);
INSERT INTO `yh_regions` VALUES (1838, 430111, 430100, '雨花区', NULL);
INSERT INTO `yh_regions` VALUES (1839, 430112, 430100, '望城区', NULL);
INSERT INTO `yh_regions` VALUES (1840, 430121, 430100, '长沙县', NULL);
INSERT INTO `yh_regions` VALUES (1841, 430181, 430100, '浏阳市', NULL);
INSERT INTO `yh_regions` VALUES (1842, 430182, 430100, '宁乡市', NULL);
INSERT INTO `yh_regions` VALUES (1843, 430202, 430200, '荷塘区', NULL);
INSERT INTO `yh_regions` VALUES (1844, 430203, 430200, '芦淞区', NULL);
INSERT INTO `yh_regions` VALUES (1845, 430204, 430200, '石峰区', NULL);
INSERT INTO `yh_regions` VALUES (1846, 430211, 430200, '天元区', NULL);
INSERT INTO `yh_regions` VALUES (1847, 430221, 430200, '株洲县', NULL);
INSERT INTO `yh_regions` VALUES (1848, 430223, 430200, '攸县', NULL);
INSERT INTO `yh_regions` VALUES (1849, 430224, 430200, '茶陵县', NULL);
INSERT INTO `yh_regions` VALUES (1850, 430225, 430200, '炎陵县', NULL);
INSERT INTO `yh_regions` VALUES (1851, 430281, 430200, '醴陵市', NULL);
INSERT INTO `yh_regions` VALUES (1852, 430302, 430300, '雨湖区', NULL);
INSERT INTO `yh_regions` VALUES (1853, 430304, 430300, '岳塘区', NULL);
INSERT INTO `yh_regions` VALUES (1854, 430321, 430300, '湘潭县', NULL);
INSERT INTO `yh_regions` VALUES (1855, 430381, 430300, '湘乡市', NULL);
INSERT INTO `yh_regions` VALUES (1856, 430382, 430300, '韶山市', NULL);
INSERT INTO `yh_regions` VALUES (1857, 430405, 430400, '珠晖区', NULL);
INSERT INTO `yh_regions` VALUES (1858, 430406, 430400, '雁峰区', NULL);
INSERT INTO `yh_regions` VALUES (1859, 430407, 430400, '石鼓区', NULL);
INSERT INTO `yh_regions` VALUES (1860, 430408, 430400, '蒸湘区', NULL);
INSERT INTO `yh_regions` VALUES (1861, 430412, 430400, '南岳区', NULL);
INSERT INTO `yh_regions` VALUES (1862, 430421, 430400, '衡阳县', NULL);
INSERT INTO `yh_regions` VALUES (1863, 430422, 430400, '衡南县', NULL);
INSERT INTO `yh_regions` VALUES (1864, 430423, 430400, '衡山县', NULL);
INSERT INTO `yh_regions` VALUES (1865, 430424, 430400, '衡东县', NULL);
INSERT INTO `yh_regions` VALUES (1866, 430426, 430400, '祁东县', NULL);
INSERT INTO `yh_regions` VALUES (1867, 430481, 430400, '耒阳市', NULL);
INSERT INTO `yh_regions` VALUES (1868, 430482, 430400, '常宁市', NULL);
INSERT INTO `yh_regions` VALUES (1869, 430502, 430500, '双清区', NULL);
INSERT INTO `yh_regions` VALUES (1870, 430503, 430500, '大祥区', NULL);
INSERT INTO `yh_regions` VALUES (1871, 430511, 430500, '北塔区', NULL);
INSERT INTO `yh_regions` VALUES (1872, 430521, 430500, '邵东县', NULL);
INSERT INTO `yh_regions` VALUES (1873, 430522, 430500, '新邵县', NULL);
INSERT INTO `yh_regions` VALUES (1874, 430523, 430500, '邵阳县', NULL);
INSERT INTO `yh_regions` VALUES (1875, 430524, 430500, '隆回县', NULL);
INSERT INTO `yh_regions` VALUES (1876, 430525, 430500, '洞口县', NULL);
INSERT INTO `yh_regions` VALUES (1877, 430527, 430500, '绥宁县', NULL);
INSERT INTO `yh_regions` VALUES (1878, 430528, 430500, '新宁县', NULL);
INSERT INTO `yh_regions` VALUES (1879, 430529, 430500, '城步苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1880, 430581, 430500, '武冈市', NULL);
INSERT INTO `yh_regions` VALUES (1881, 430602, 430600, '岳阳楼区', NULL);
INSERT INTO `yh_regions` VALUES (1882, 430603, 430600, '云溪区', NULL);
INSERT INTO `yh_regions` VALUES (1883, 430611, 430600, '君山区', NULL);
INSERT INTO `yh_regions` VALUES (1884, 430621, 430600, '岳阳县', NULL);
INSERT INTO `yh_regions` VALUES (1885, 430623, 430600, '华容县', NULL);
INSERT INTO `yh_regions` VALUES (1886, 430624, 430600, '湘阴县', NULL);
INSERT INTO `yh_regions` VALUES (1887, 430626, 430600, '平江县', NULL);
INSERT INTO `yh_regions` VALUES (1888, 430681, 430600, '汨罗市', NULL);
INSERT INTO `yh_regions` VALUES (1889, 430682, 430600, '临湘市', NULL);
INSERT INTO `yh_regions` VALUES (1890, 430702, 430700, '武陵区', NULL);
INSERT INTO `yh_regions` VALUES (1891, 430703, 430700, '鼎城区', NULL);
INSERT INTO `yh_regions` VALUES (1892, 430721, 430700, '安乡县', NULL);
INSERT INTO `yh_regions` VALUES (1893, 430722, 430700, '汉寿县', NULL);
INSERT INTO `yh_regions` VALUES (1894, 430723, 430700, '澧县', NULL);
INSERT INTO `yh_regions` VALUES (1895, 430724, 430700, '临澧县', NULL);
INSERT INTO `yh_regions` VALUES (1896, 430725, 430700, '桃源县', NULL);
INSERT INTO `yh_regions` VALUES (1897, 430726, 430700, '石门县', NULL);
INSERT INTO `yh_regions` VALUES (1898, 430781, 430700, '津市市', NULL);
INSERT INTO `yh_regions` VALUES (1899, 430802, 430800, '永定区', NULL);
INSERT INTO `yh_regions` VALUES (1900, 430811, 430800, '武陵源区', NULL);
INSERT INTO `yh_regions` VALUES (1901, 430821, 430800, '慈利县', NULL);
INSERT INTO `yh_regions` VALUES (1902, 430822, 430800, '桑植县', NULL);
INSERT INTO `yh_regions` VALUES (1903, 430902, 430900, '资阳区', NULL);
INSERT INTO `yh_regions` VALUES (1904, 430903, 430900, '赫山区', NULL);
INSERT INTO `yh_regions` VALUES (1905, 430921, 430900, '南县', NULL);
INSERT INTO `yh_regions` VALUES (1906, 430922, 430900, '桃江县', NULL);
INSERT INTO `yh_regions` VALUES (1907, 430923, 430900, '安化县', NULL);
INSERT INTO `yh_regions` VALUES (1908, 430981, 430900, '沅江市', NULL);
INSERT INTO `yh_regions` VALUES (1909, 431002, 431000, '北湖区', NULL);
INSERT INTO `yh_regions` VALUES (1910, 431003, 431000, '苏仙区', NULL);
INSERT INTO `yh_regions` VALUES (1911, 431021, 431000, '桂阳县', NULL);
INSERT INTO `yh_regions` VALUES (1912, 431022, 431000, '宜章县', NULL);
INSERT INTO `yh_regions` VALUES (1913, 431023, 431000, '永兴县', NULL);
INSERT INTO `yh_regions` VALUES (1914, 431024, 431000, '嘉禾县', NULL);
INSERT INTO `yh_regions` VALUES (1915, 431025, 431000, '临武县', NULL);
INSERT INTO `yh_regions` VALUES (1916, 431026, 431000, '汝城县', NULL);
INSERT INTO `yh_regions` VALUES (1917, 431027, 431000, '桂东县', NULL);
INSERT INTO `yh_regions` VALUES (1918, 431028, 431000, '安仁县', NULL);
INSERT INTO `yh_regions` VALUES (1919, 431081, 431000, '资兴市', NULL);
INSERT INTO `yh_regions` VALUES (1920, 431102, 431100, '零陵区', NULL);
INSERT INTO `yh_regions` VALUES (1921, 431103, 431100, '冷水滩区', NULL);
INSERT INTO `yh_regions` VALUES (1922, 431121, 431100, '祁阳县', NULL);
INSERT INTO `yh_regions` VALUES (1923, 431122, 431100, '东安县', NULL);
INSERT INTO `yh_regions` VALUES (1924, 431123, 431100, '双牌县', NULL);
INSERT INTO `yh_regions` VALUES (1925, 431124, 431100, '道县', NULL);
INSERT INTO `yh_regions` VALUES (1926, 431125, 431100, '江永县', NULL);
INSERT INTO `yh_regions` VALUES (1927, 431126, 431100, '宁远县', NULL);
INSERT INTO `yh_regions` VALUES (1928, 431127, 431100, '蓝山县', NULL);
INSERT INTO `yh_regions` VALUES (1929, 431128, 431100, '新田县', NULL);
INSERT INTO `yh_regions` VALUES (1930, 431129, 431100, '江华瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1931, 431202, 431200, '鹤城区', NULL);
INSERT INTO `yh_regions` VALUES (1932, 431221, 431200, '中方县', NULL);
INSERT INTO `yh_regions` VALUES (1933, 431222, 431200, '沅陵县', NULL);
INSERT INTO `yh_regions` VALUES (1934, 431223, 431200, '辰溪县', NULL);
INSERT INTO `yh_regions` VALUES (1935, 431224, 431200, '溆浦县', NULL);
INSERT INTO `yh_regions` VALUES (1936, 431225, 431200, '会同县', NULL);
INSERT INTO `yh_regions` VALUES (1937, 431226, 431200, '麻阳苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1938, 431227, 431200, '新晃侗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1939, 431228, 431200, '芷江侗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1940, 431229, 431200, '靖州苗族侗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1941, 431230, 431200, '通道侗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1942, 431281, 431200, '洪江市', NULL);
INSERT INTO `yh_regions` VALUES (1943, 431302, 431300, '娄星区', NULL);
INSERT INTO `yh_regions` VALUES (1944, 431321, 431300, '双峰县', NULL);
INSERT INTO `yh_regions` VALUES (1945, 431322, 431300, '新化县', NULL);
INSERT INTO `yh_regions` VALUES (1946, 431381, 431300, '冷水江市', NULL);
INSERT INTO `yh_regions` VALUES (1947, 431382, 431300, '涟源市', NULL);
INSERT INTO `yh_regions` VALUES (1948, 433101, 433100, '吉首市', NULL);
INSERT INTO `yh_regions` VALUES (1949, 433122, 433100, '泸溪县', NULL);
INSERT INTO `yh_regions` VALUES (1950, 433123, 433100, '凤凰县', NULL);
INSERT INTO `yh_regions` VALUES (1951, 433124, 433100, '花垣县', NULL);
INSERT INTO `yh_regions` VALUES (1952, 433125, 433100, '保靖县', NULL);
INSERT INTO `yh_regions` VALUES (1953, 433126, 433100, '古丈县', NULL);
INSERT INTO `yh_regions` VALUES (1954, 433127, 433100, '永顺县', NULL);
INSERT INTO `yh_regions` VALUES (1955, 433130, 433100, '龙山县', NULL);
INSERT INTO `yh_regions` VALUES (1956, 440100, 440000, '广州市', NULL);
INSERT INTO `yh_regions` VALUES (1957, 440200, 440000, '韶关市', NULL);
INSERT INTO `yh_regions` VALUES (1958, 440300, 440000, '深圳市', NULL);
INSERT INTO `yh_regions` VALUES (1959, 440400, 440000, '珠海市', NULL);
INSERT INTO `yh_regions` VALUES (1960, 440500, 440000, '汕头市', NULL);
INSERT INTO `yh_regions` VALUES (1961, 440600, 440000, '佛山市', NULL);
INSERT INTO `yh_regions` VALUES (1962, 440700, 440000, '江门市', NULL);
INSERT INTO `yh_regions` VALUES (1963, 440800, 440000, '湛江市', NULL);
INSERT INTO `yh_regions` VALUES (1964, 440900, 440000, '茂名市', NULL);
INSERT INTO `yh_regions` VALUES (1965, 441200, 440000, '肇庆市', NULL);
INSERT INTO `yh_regions` VALUES (1966, 441300, 440000, '惠州市', NULL);
INSERT INTO `yh_regions` VALUES (1967, 441400, 440000, '梅州市', NULL);
INSERT INTO `yh_regions` VALUES (1968, 441500, 440000, '汕尾市', NULL);
INSERT INTO `yh_regions` VALUES (1969, 441600, 440000, '河源市', NULL);
INSERT INTO `yh_regions` VALUES (1970, 441700, 440000, '阳江市', NULL);
INSERT INTO `yh_regions` VALUES (1971, 441800, 440000, '清远市', NULL);
INSERT INTO `yh_regions` VALUES (1972, 441900, 440000, '东莞市', NULL);
INSERT INTO `yh_regions` VALUES (1973, 442000, 440000, '中山市', NULL);
INSERT INTO `yh_regions` VALUES (1974, 442100, 440000, '东沙群岛', NULL);
INSERT INTO `yh_regions` VALUES (1975, 445100, 440000, '潮州市', NULL);
INSERT INTO `yh_regions` VALUES (1976, 445200, 440000, '揭阳市', NULL);
INSERT INTO `yh_regions` VALUES (1977, 445300, 440000, '云浮市', NULL);
INSERT INTO `yh_regions` VALUES (1978, 440103, 440100, '荔湾区', NULL);
INSERT INTO `yh_regions` VALUES (1979, 440104, 440100, '越秀区', NULL);
INSERT INTO `yh_regions` VALUES (1980, 440105, 440100, '海珠区', NULL);
INSERT INTO `yh_regions` VALUES (1981, 440106, 440100, '天河区', NULL);
INSERT INTO `yh_regions` VALUES (1982, 440111, 440100, '白云区', NULL);
INSERT INTO `yh_regions` VALUES (1983, 440112, 440100, '黄埔区', NULL);
INSERT INTO `yh_regions` VALUES (1984, 440113, 440100, '番禺区', NULL);
INSERT INTO `yh_regions` VALUES (1985, 440114, 440100, '花都区', NULL);
INSERT INTO `yh_regions` VALUES (1986, 440115, 440100, '南沙区', NULL);
INSERT INTO `yh_regions` VALUES (1987, 440117, 440100, '从化区', NULL);
INSERT INTO `yh_regions` VALUES (1988, 440118, 440100, '增城区', NULL);
INSERT INTO `yh_regions` VALUES (1989, 440203, 440200, '武江区', NULL);
INSERT INTO `yh_regions` VALUES (1990, 440204, 440200, '浈江区', NULL);
INSERT INTO `yh_regions` VALUES (1991, 440205, 440200, '曲江区', NULL);
INSERT INTO `yh_regions` VALUES (1992, 440222, 440200, '始兴县', NULL);
INSERT INTO `yh_regions` VALUES (1993, 440224, 440200, '仁化县', NULL);
INSERT INTO `yh_regions` VALUES (1994, 440229, 440200, '翁源县', NULL);
INSERT INTO `yh_regions` VALUES (1995, 440232, 440200, '乳源瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (1996, 440233, 440200, '新丰县', NULL);
INSERT INTO `yh_regions` VALUES (1997, 440281, 440200, '乐昌市', NULL);
INSERT INTO `yh_regions` VALUES (1998, 440282, 440200, '南雄市', NULL);
INSERT INTO `yh_regions` VALUES (1999, 440303, 440300, '罗湖区', NULL);
INSERT INTO `yh_regions` VALUES (2000, 440304, 440300, '福田区', NULL);
INSERT INTO `yh_regions` VALUES (2001, 440305, 440300, '南山区', NULL);
INSERT INTO `yh_regions` VALUES (2002, 440306, 440300, '宝安区', NULL);
INSERT INTO `yh_regions` VALUES (2003, 440307, 440300, '龙岗区', NULL);
INSERT INTO `yh_regions` VALUES (2004, 440308, 440300, '盐田区', NULL);
INSERT INTO `yh_regions` VALUES (2005, 440309, 440300, '龙华区', NULL);
INSERT INTO `yh_regions` VALUES (2006, 440310, 440300, '坪山区', NULL);
INSERT INTO `yh_regions` VALUES (2007, 440402, 440400, '香洲区', NULL);
INSERT INTO `yh_regions` VALUES (2008, 440403, 440400, '斗门区', NULL);
INSERT INTO `yh_regions` VALUES (2009, 440404, 440400, '金湾区', NULL);
INSERT INTO `yh_regions` VALUES (2010, 440499, 440400, '澳门大学横琴校区(由澳门管辖)', NULL);
INSERT INTO `yh_regions` VALUES (2011, 440507, 440500, '龙湖区', NULL);
INSERT INTO `yh_regions` VALUES (2012, 440511, 440500, '金平区', NULL);
INSERT INTO `yh_regions` VALUES (2013, 440512, 440500, '濠江区', NULL);
INSERT INTO `yh_regions` VALUES (2014, 440513, 440500, '潮阳区', NULL);
INSERT INTO `yh_regions` VALUES (2015, 440514, 440500, '潮南区', NULL);
INSERT INTO `yh_regions` VALUES (2016, 440515, 440500, '澄海区', NULL);
INSERT INTO `yh_regions` VALUES (2017, 440523, 440500, '南澳县', NULL);
INSERT INTO `yh_regions` VALUES (2018, 440604, 440600, '禅城区', NULL);
INSERT INTO `yh_regions` VALUES (2019, 440605, 440600, '南海区', NULL);
INSERT INTO `yh_regions` VALUES (2020, 440606, 440600, '顺德区', NULL);
INSERT INTO `yh_regions` VALUES (2021, 440607, 440600, '三水区', NULL);
INSERT INTO `yh_regions` VALUES (2022, 440608, 440600, '高明区', NULL);
INSERT INTO `yh_regions` VALUES (2023, 440703, 440700, '蓬江区', NULL);
INSERT INTO `yh_regions` VALUES (2024, 440704, 440700, '江海区', NULL);
INSERT INTO `yh_regions` VALUES (2025, 440705, 440700, '新会区', NULL);
INSERT INTO `yh_regions` VALUES (2026, 440781, 440700, '台山市', NULL);
INSERT INTO `yh_regions` VALUES (2027, 440783, 440700, '开平市', NULL);
INSERT INTO `yh_regions` VALUES (2028, 440784, 440700, '鹤山市', NULL);
INSERT INTO `yh_regions` VALUES (2029, 440785, 440700, '恩平市', NULL);
INSERT INTO `yh_regions` VALUES (2030, 440802, 440800, '赤坎区', NULL);
INSERT INTO `yh_regions` VALUES (2031, 440803, 440800, '霞山区', NULL);
INSERT INTO `yh_regions` VALUES (2032, 440804, 440800, '坡头区', NULL);
INSERT INTO `yh_regions` VALUES (2033, 440811, 440800, '麻章区', NULL);
INSERT INTO `yh_regions` VALUES (2034, 440823, 440800, '遂溪县', NULL);
INSERT INTO `yh_regions` VALUES (2035, 440825, 440800, '徐闻县', NULL);
INSERT INTO `yh_regions` VALUES (2036, 440881, 440800, '廉江市', NULL);
INSERT INTO `yh_regions` VALUES (2037, 440882, 440800, '雷州市', NULL);
INSERT INTO `yh_regions` VALUES (2038, 440883, 440800, '吴川市', NULL);
INSERT INTO `yh_regions` VALUES (2039, 440902, 440900, '茂南区', NULL);
INSERT INTO `yh_regions` VALUES (2040, 440904, 440900, '电白区', NULL);
INSERT INTO `yh_regions` VALUES (2041, 440981, 440900, '高州市', NULL);
INSERT INTO `yh_regions` VALUES (2042, 440982, 440900, '化州市', NULL);
INSERT INTO `yh_regions` VALUES (2043, 440983, 440900, '信宜市', NULL);
INSERT INTO `yh_regions` VALUES (2044, 441202, 441200, '端州区', NULL);
INSERT INTO `yh_regions` VALUES (2045, 441203, 441200, '鼎湖区', NULL);
INSERT INTO `yh_regions` VALUES (2046, 441204, 441200, '高要区', NULL);
INSERT INTO `yh_regions` VALUES (2047, 441223, 441200, '广宁县', NULL);
INSERT INTO `yh_regions` VALUES (2048, 441224, 441200, '怀集县', NULL);
INSERT INTO `yh_regions` VALUES (2049, 441225, 441200, '封开县', NULL);
INSERT INTO `yh_regions` VALUES (2050, 441226, 441200, '德庆县', NULL);
INSERT INTO `yh_regions` VALUES (2051, 441284, 441200, '四会市', NULL);
INSERT INTO `yh_regions` VALUES (2052, 441302, 441300, '惠城区', NULL);
INSERT INTO `yh_regions` VALUES (2053, 441303, 441300, '惠阳区', NULL);
INSERT INTO `yh_regions` VALUES (2054, 441322, 441300, '博罗县', NULL);
INSERT INTO `yh_regions` VALUES (2055, 441323, 441300, '惠东县', NULL);
INSERT INTO `yh_regions` VALUES (2056, 441324, 441300, '龙门县', NULL);
INSERT INTO `yh_regions` VALUES (2057, 441402, 441400, '梅江区', NULL);
INSERT INTO `yh_regions` VALUES (2058, 441403, 441400, '梅县区', NULL);
INSERT INTO `yh_regions` VALUES (2059, 441422, 441400, '大埔县', NULL);
INSERT INTO `yh_regions` VALUES (2060, 441423, 441400, '丰顺县', NULL);
INSERT INTO `yh_regions` VALUES (2061, 441424, 441400, '五华县', NULL);
INSERT INTO `yh_regions` VALUES (2062, 441426, 441400, '平远县', NULL);
INSERT INTO `yh_regions` VALUES (2063, 441427, 441400, '蕉岭县', NULL);
INSERT INTO `yh_regions` VALUES (2064, 441481, 441400, '兴宁市', NULL);
INSERT INTO `yh_regions` VALUES (2065, 441502, 441500, '城区', NULL);
INSERT INTO `yh_regions` VALUES (2066, 441521, 441500, '海丰县', NULL);
INSERT INTO `yh_regions` VALUES (2067, 441523, 441500, '陆河县', NULL);
INSERT INTO `yh_regions` VALUES (2068, 441581, 441500, '陆丰市', NULL);
INSERT INTO `yh_regions` VALUES (2069, 441602, 441600, '源城区', NULL);
INSERT INTO `yh_regions` VALUES (2070, 441621, 441600, '紫金县', NULL);
INSERT INTO `yh_regions` VALUES (2071, 441622, 441600, '龙川县', NULL);
INSERT INTO `yh_regions` VALUES (2072, 441623, 441600, '连平县', NULL);
INSERT INTO `yh_regions` VALUES (2073, 441624, 441600, '和平县', NULL);
INSERT INTO `yh_regions` VALUES (2074, 441625, 441600, '东源县', NULL);
INSERT INTO `yh_regions` VALUES (2075, 441702, 441700, '江城区', NULL);
INSERT INTO `yh_regions` VALUES (2076, 441704, 441700, '阳东区', NULL);
INSERT INTO `yh_regions` VALUES (2077, 441721, 441700, '阳西县', NULL);
INSERT INTO `yh_regions` VALUES (2078, 441781, 441700, '阳春市', NULL);
INSERT INTO `yh_regions` VALUES (2079, 441802, 441800, '清城区', NULL);
INSERT INTO `yh_regions` VALUES (2080, 441803, 441800, '清新区', NULL);
INSERT INTO `yh_regions` VALUES (2081, 441821, 441800, '佛冈县', NULL);
INSERT INTO `yh_regions` VALUES (2082, 441823, 441800, '阳山县', NULL);
INSERT INTO `yh_regions` VALUES (2083, 441825, 441800, '连山壮族瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2084, 441826, 441800, '连南瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2085, 441881, 441800, '英德市', NULL);
INSERT INTO `yh_regions` VALUES (2086, 441882, 441800, '连州市', NULL);
INSERT INTO `yh_regions` VALUES (2087, 441900, 441900, '东莞市', NULL);
INSERT INTO `yh_regions` VALUES (2088, 442000, 442000, '中山市', NULL);
INSERT INTO `yh_regions` VALUES (2089, 442100, 442100, '东沙群岛', NULL);
INSERT INTO `yh_regions` VALUES (2090, 445102, 445100, '湘桥区', NULL);
INSERT INTO `yh_regions` VALUES (2091, 445103, 445100, '潮安区', NULL);
INSERT INTO `yh_regions` VALUES (2092, 445122, 445100, '饶平县', NULL);
INSERT INTO `yh_regions` VALUES (2093, 445202, 445200, '榕城区', NULL);
INSERT INTO `yh_regions` VALUES (2094, 445203, 445200, '揭东区', NULL);
INSERT INTO `yh_regions` VALUES (2095, 445222, 445200, '揭西县', NULL);
INSERT INTO `yh_regions` VALUES (2096, 445224, 445200, '惠来县', NULL);
INSERT INTO `yh_regions` VALUES (2097, 445281, 445200, '普宁市', NULL);
INSERT INTO `yh_regions` VALUES (2098, 445302, 445300, '云城区', NULL);
INSERT INTO `yh_regions` VALUES (2099, 445303, 445300, '云安区', NULL);
INSERT INTO `yh_regions` VALUES (2100, 445321, 445300, '新兴县', NULL);
INSERT INTO `yh_regions` VALUES (2101, 445322, 445300, '郁南县', NULL);
INSERT INTO `yh_regions` VALUES (2102, 445381, 445300, '罗定市', NULL);
INSERT INTO `yh_regions` VALUES (2103, 450100, 450000, '南宁市', NULL);
INSERT INTO `yh_regions` VALUES (2104, 450200, 450000, '柳州市', NULL);
INSERT INTO `yh_regions` VALUES (2105, 450300, 450000, '桂林市', NULL);
INSERT INTO `yh_regions` VALUES (2106, 450400, 450000, '梧州市', NULL);
INSERT INTO `yh_regions` VALUES (2107, 450500, 450000, '北海市', NULL);
INSERT INTO `yh_regions` VALUES (2108, 450600, 450000, '防城港市', NULL);
INSERT INTO `yh_regions` VALUES (2109, 450700, 450000, '钦州市', NULL);
INSERT INTO `yh_regions` VALUES (2110, 450800, 450000, '贵港市', NULL);
INSERT INTO `yh_regions` VALUES (2111, 450900, 450000, '玉林市', NULL);
INSERT INTO `yh_regions` VALUES (2112, 451000, 450000, '百色市', NULL);
INSERT INTO `yh_regions` VALUES (2113, 451100, 450000, '贺州市', NULL);
INSERT INTO `yh_regions` VALUES (2114, 451200, 450000, '河池市', NULL);
INSERT INTO `yh_regions` VALUES (2115, 451300, 450000, '来宾市', NULL);
INSERT INTO `yh_regions` VALUES (2116, 451400, 450000, '崇左市', NULL);
INSERT INTO `yh_regions` VALUES (2117, 450102, 450100, '兴宁区', NULL);
INSERT INTO `yh_regions` VALUES (2118, 450103, 450100, '青秀区', NULL);
INSERT INTO `yh_regions` VALUES (2119, 450105, 450100, '江南区', NULL);
INSERT INTO `yh_regions` VALUES (2120, 450107, 450100, '西乡塘区', NULL);
INSERT INTO `yh_regions` VALUES (2121, 450108, 450100, '良庆区', NULL);
INSERT INTO `yh_regions` VALUES (2122, 450109, 450100, '邕宁区', NULL);
INSERT INTO `yh_regions` VALUES (2123, 450110, 450100, '武鸣区', NULL);
INSERT INTO `yh_regions` VALUES (2124, 450123, 450100, '隆安县', NULL);
INSERT INTO `yh_regions` VALUES (2125, 450124, 450100, '马山县', NULL);
INSERT INTO `yh_regions` VALUES (2126, 450125, 450100, '上林县', NULL);
INSERT INTO `yh_regions` VALUES (2127, 450126, 450100, '宾阳县', NULL);
INSERT INTO `yh_regions` VALUES (2128, 450127, 450100, '横县', NULL);
INSERT INTO `yh_regions` VALUES (2129, 450202, 450200, '城中区', NULL);
INSERT INTO `yh_regions` VALUES (2130, 450203, 450200, '鱼峰区', NULL);
INSERT INTO `yh_regions` VALUES (2131, 450204, 450200, '柳南区', NULL);
INSERT INTO `yh_regions` VALUES (2132, 450205, 450200, '柳北区', NULL);
INSERT INTO `yh_regions` VALUES (2133, 450206, 450200, '柳江区', NULL);
INSERT INTO `yh_regions` VALUES (2134, 450222, 450200, '柳城县', NULL);
INSERT INTO `yh_regions` VALUES (2135, 450223, 450200, '鹿寨县', NULL);
INSERT INTO `yh_regions` VALUES (2136, 450224, 450200, '融安县', NULL);
INSERT INTO `yh_regions` VALUES (2137, 450225, 450200, '融水苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2138, 450226, 450200, '三江侗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2139, 450302, 450300, '秀峰区', NULL);
INSERT INTO `yh_regions` VALUES (2140, 450303, 450300, '叠彩区', NULL);
INSERT INTO `yh_regions` VALUES (2141, 450304, 450300, '象山区', NULL);
INSERT INTO `yh_regions` VALUES (2142, 450305, 450300, '七星区', NULL);
INSERT INTO `yh_regions` VALUES (2143, 450311, 450300, '雁山区', NULL);
INSERT INTO `yh_regions` VALUES (2144, 450312, 450300, '临桂区', NULL);
INSERT INTO `yh_regions` VALUES (2145, 450321, 450300, '阳朔县', NULL);
INSERT INTO `yh_regions` VALUES (2146, 450323, 450300, '灵川县', NULL);
INSERT INTO `yh_regions` VALUES (2147, 450324, 450300, '全州县', NULL);
INSERT INTO `yh_regions` VALUES (2148, 450325, 450300, '兴安县', NULL);
INSERT INTO `yh_regions` VALUES (2149, 450326, 450300, '永福县', NULL);
INSERT INTO `yh_regions` VALUES (2150, 450327, 450300, '灌阳县', NULL);
INSERT INTO `yh_regions` VALUES (2151, 450328, 450300, '龙胜各族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2152, 450329, 450300, '资源县', NULL);
INSERT INTO `yh_regions` VALUES (2153, 450330, 450300, '平乐县', NULL);
INSERT INTO `yh_regions` VALUES (2154, 450331, 450300, '荔浦县', NULL);
INSERT INTO `yh_regions` VALUES (2155, 450332, 450300, '恭城瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2156, 450403, 450400, '万秀区', NULL);
INSERT INTO `yh_regions` VALUES (2157, 450405, 450400, '长洲区', NULL);
INSERT INTO `yh_regions` VALUES (2158, 450406, 450400, '龙圩区', NULL);
INSERT INTO `yh_regions` VALUES (2159, 450421, 450400, '苍梧县', NULL);
INSERT INTO `yh_regions` VALUES (2160, 450422, 450400, '藤县', NULL);
INSERT INTO `yh_regions` VALUES (2161, 450423, 450400, '蒙山县', NULL);
INSERT INTO `yh_regions` VALUES (2162, 450481, 450400, '岑溪市', NULL);
INSERT INTO `yh_regions` VALUES (2163, 450502, 450500, '海城区', NULL);
INSERT INTO `yh_regions` VALUES (2164, 450503, 450500, '银海区', NULL);
INSERT INTO `yh_regions` VALUES (2165, 450512, 450500, '铁山港区', NULL);
INSERT INTO `yh_regions` VALUES (2166, 450521, 450500, '合浦县', NULL);
INSERT INTO `yh_regions` VALUES (2167, 450602, 450600, '港口区', NULL);
INSERT INTO `yh_regions` VALUES (2168, 450603, 450600, '防城区', NULL);
INSERT INTO `yh_regions` VALUES (2169, 450621, 450600, '上思县', NULL);
INSERT INTO `yh_regions` VALUES (2170, 450681, 450600, '东兴市', NULL);
INSERT INTO `yh_regions` VALUES (2171, 450702, 450700, '钦南区', NULL);
INSERT INTO `yh_regions` VALUES (2172, 450703, 450700, '钦北区', NULL);
INSERT INTO `yh_regions` VALUES (2173, 450721, 450700, '灵山县', NULL);
INSERT INTO `yh_regions` VALUES (2174, 450722, 450700, '浦北县', NULL);
INSERT INTO `yh_regions` VALUES (2175, 450802, 450800, '港北区', NULL);
INSERT INTO `yh_regions` VALUES (2176, 450803, 450800, '港南区', NULL);
INSERT INTO `yh_regions` VALUES (2177, 450804, 450800, '覃塘区', NULL);
INSERT INTO `yh_regions` VALUES (2178, 450821, 450800, '平南县', NULL);
INSERT INTO `yh_regions` VALUES (2179, 450881, 450800, '桂平市', NULL);
INSERT INTO `yh_regions` VALUES (2180, 450902, 450900, '玉州区', NULL);
INSERT INTO `yh_regions` VALUES (2181, 450903, 450900, '福绵区', NULL);
INSERT INTO `yh_regions` VALUES (2182, 450921, 450900, '容县', NULL);
INSERT INTO `yh_regions` VALUES (2183, 450922, 450900, '陆川县', NULL);
INSERT INTO `yh_regions` VALUES (2184, 450923, 450900, '博白县', NULL);
INSERT INTO `yh_regions` VALUES (2185, 450924, 450900, '兴业县', NULL);
INSERT INTO `yh_regions` VALUES (2186, 450981, 450900, '北流市', NULL);
INSERT INTO `yh_regions` VALUES (2187, 451002, 451000, '右江区', NULL);
INSERT INTO `yh_regions` VALUES (2188, 451021, 451000, '田阳区', NULL);
INSERT INTO `yh_regions` VALUES (2189, 451022, 451000, '田东县', NULL);
INSERT INTO `yh_regions` VALUES (2190, 451023, 451000, '平果县', NULL);
INSERT INTO `yh_regions` VALUES (2191, 451024, 451000, '德保县', NULL);
INSERT INTO `yh_regions` VALUES (2192, 451026, 451000, '那坡县', NULL);
INSERT INTO `yh_regions` VALUES (2193, 451027, 451000, '凌云县', NULL);
INSERT INTO `yh_regions` VALUES (2194, 451028, 451000, '乐业县', NULL);
INSERT INTO `yh_regions` VALUES (2195, 451029, 451000, '田林县', NULL);
INSERT INTO `yh_regions` VALUES (2196, 451030, 451000, '西林县', NULL);
INSERT INTO `yh_regions` VALUES (2197, 451031, 451000, '隆林各族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2198, 451081, 451000, '靖西市', NULL);
INSERT INTO `yh_regions` VALUES (2199, 451102, 451100, '八步区', NULL);
INSERT INTO `yh_regions` VALUES (2200, 451103, 451100, '平桂区', NULL);
INSERT INTO `yh_regions` VALUES (2201, 451121, 451100, '昭平县', NULL);
INSERT INTO `yh_regions` VALUES (2202, 451122, 451100, '钟山县', NULL);
INSERT INTO `yh_regions` VALUES (2203, 451123, 451100, '富川瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2204, 451202, 451200, '金城江区', NULL);
INSERT INTO `yh_regions` VALUES (2205, 451203, 451200, '宜州区', NULL);
INSERT INTO `yh_regions` VALUES (2206, 451221, 451200, '南丹县', NULL);
INSERT INTO `yh_regions` VALUES (2207, 451222, 451200, '天峨县', NULL);
INSERT INTO `yh_regions` VALUES (2208, 451223, 451200, '凤山县', NULL);
INSERT INTO `yh_regions` VALUES (2209, 451224, 451200, '东兰县', NULL);
INSERT INTO `yh_regions` VALUES (2210, 451225, 451200, '罗城仫佬族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2211, 451226, 451200, '环江毛南族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2212, 451227, 451200, '巴马瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2213, 451228, 451200, '都安瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2214, 451229, 451200, '大化瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2215, 451302, 451300, '兴宾区', NULL);
INSERT INTO `yh_regions` VALUES (2216, 451321, 451300, '忻城县', NULL);
INSERT INTO `yh_regions` VALUES (2217, 451322, 451300, '象州县', NULL);
INSERT INTO `yh_regions` VALUES (2218, 451323, 451300, '武宣县', NULL);
INSERT INTO `yh_regions` VALUES (2219, 451324, 451300, '金秀瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2220, 451381, 451300, '合山市', NULL);
INSERT INTO `yh_regions` VALUES (2221, 451402, 451400, '江州区', NULL);
INSERT INTO `yh_regions` VALUES (2222, 451421, 451400, '扶绥县', NULL);
INSERT INTO `yh_regions` VALUES (2223, 451422, 451400, '宁明县', NULL);
INSERT INTO `yh_regions` VALUES (2224, 451423, 451400, '龙州县', NULL);
INSERT INTO `yh_regions` VALUES (2225, 451424, 451400, '大新县', NULL);
INSERT INTO `yh_regions` VALUES (2226, 451425, 451400, '天等县', NULL);
INSERT INTO `yh_regions` VALUES (2227, 451481, 451400, '凭祥市', NULL);
INSERT INTO `yh_regions` VALUES (2228, 460100, 460000, '海口市', NULL);
INSERT INTO `yh_regions` VALUES (2229, 460200, 460000, '三亚市', NULL);
INSERT INTO `yh_regions` VALUES (2230, 460300, 460000, '三沙市', NULL);
INSERT INTO `yh_regions` VALUES (2231, 460400, 460000, '儋州市', NULL);
INSERT INTO `yh_regions` VALUES (2232, 469001, 460000, '五指山市', NULL);
INSERT INTO `yh_regions` VALUES (2233, 469002, 460000, '琼海市', NULL);
INSERT INTO `yh_regions` VALUES (2234, 469005, 460000, '文昌市', NULL);
INSERT INTO `yh_regions` VALUES (2235, 469006, 460000, '万宁市', NULL);
INSERT INTO `yh_regions` VALUES (2236, 469007, 460000, '东方市', NULL);
INSERT INTO `yh_regions` VALUES (2237, 469021, 460000, '定安县', NULL);
INSERT INTO `yh_regions` VALUES (2238, 469022, 460000, '屯昌县', NULL);
INSERT INTO `yh_regions` VALUES (2239, 469023, 460000, '澄迈县', NULL);
INSERT INTO `yh_regions` VALUES (2240, 469024, 460000, '临高县', NULL);
INSERT INTO `yh_regions` VALUES (2241, 469025, 460000, '白沙黎族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2242, 469026, 460000, '昌江黎族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2243, 469027, 460000, '乐东黎族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2244, 469028, 460000, '陵水黎族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2245, 469029, 460000, '保亭黎族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2246, 469030, 460000, '琼中黎族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2247, 460105, 460100, '秀英区', NULL);
INSERT INTO `yh_regions` VALUES (2248, 460106, 460100, '龙华区', NULL);
INSERT INTO `yh_regions` VALUES (2249, 460107, 460100, '琼山区', NULL);
INSERT INTO `yh_regions` VALUES (2250, 460108, 460100, '美兰区', NULL);
INSERT INTO `yh_regions` VALUES (2251, 460202, 460200, '海棠区', NULL);
INSERT INTO `yh_regions` VALUES (2252, 460203, 460200, '吉阳区', NULL);
INSERT INTO `yh_regions` VALUES (2253, 460204, 460200, '天涯区', NULL);
INSERT INTO `yh_regions` VALUES (2254, 460205, 460200, '崖州区', NULL);
INSERT INTO `yh_regions` VALUES (2255, 460321, 460300, '西沙群岛', NULL);
INSERT INTO `yh_regions` VALUES (2256, 460322, 460300, '南沙群岛', NULL);
INSERT INTO `yh_regions` VALUES (2257, 460323, 460300, '中沙群岛的岛礁及其海域', NULL);
INSERT INTO `yh_regions` VALUES (2258, 460400, 460400, '儋州市', NULL);
INSERT INTO `yh_regions` VALUES (2259, 469001, 469001, '五指山市', NULL);
INSERT INTO `yh_regions` VALUES (2260, 469002, 469002, '琼海市', NULL);
INSERT INTO `yh_regions` VALUES (2261, 469005, 469005, '文昌市', NULL);
INSERT INTO `yh_regions` VALUES (2262, 469006, 469006, '万宁市', NULL);
INSERT INTO `yh_regions` VALUES (2263, 469007, 469007, '东方市', NULL);
INSERT INTO `yh_regions` VALUES (2264, 469021, 469021, '定安县', NULL);
INSERT INTO `yh_regions` VALUES (2265, 469022, 469022, '屯昌县', NULL);
INSERT INTO `yh_regions` VALUES (2266, 469023, 469023, '澄迈县', NULL);
INSERT INTO `yh_regions` VALUES (2267, 469024, 469024, '临高县', NULL);
INSERT INTO `yh_regions` VALUES (2268, 469025, 469025, '白沙黎族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2269, 469026, 469026, '昌江黎族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2270, 469027, 469027, '乐东黎族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2271, 469028, 469028, '陵水黎族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2272, 469029, 469029, '保亭黎族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2273, 469030, 469030, '琼中黎族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2274, 500100, 500000, '重庆城区', NULL);
INSERT INTO `yh_regions` VALUES (2275, 500200, 500000, '重庆郊县', NULL);
INSERT INTO `yh_regions` VALUES (2276, 500101, 500100, '万州区', NULL);
INSERT INTO `yh_regions` VALUES (2277, 500102, 500100, '涪陵区', NULL);
INSERT INTO `yh_regions` VALUES (2278, 500103, 500100, '渝中区', NULL);
INSERT INTO `yh_regions` VALUES (2279, 500104, 500100, '大渡口区', NULL);
INSERT INTO `yh_regions` VALUES (2280, 500105, 500100, '江北区', NULL);
INSERT INTO `yh_regions` VALUES (2281, 500106, 500100, '沙坪坝区', NULL);
INSERT INTO `yh_regions` VALUES (2282, 500107, 500100, '九龙坡区', NULL);
INSERT INTO `yh_regions` VALUES (2283, 500108, 500100, '南岸区', NULL);
INSERT INTO `yh_regions` VALUES (2284, 500109, 500100, '北碚区', NULL);
INSERT INTO `yh_regions` VALUES (2285, 500110, 500100, '綦江区', NULL);
INSERT INTO `yh_regions` VALUES (2286, 500111, 500100, '大足区', NULL);
INSERT INTO `yh_regions` VALUES (2287, 500112, 500100, '渝北区', NULL);
INSERT INTO `yh_regions` VALUES (2288, 500113, 500100, '巴南区', NULL);
INSERT INTO `yh_regions` VALUES (2289, 500114, 500100, '黔江区', NULL);
INSERT INTO `yh_regions` VALUES (2290, 500115, 500100, '长寿区', NULL);
INSERT INTO `yh_regions` VALUES (2291, 500116, 500100, '江津区', NULL);
INSERT INTO `yh_regions` VALUES (2292, 500117, 500100, '合川区', NULL);
INSERT INTO `yh_regions` VALUES (2293, 500118, 500100, '永川区', NULL);
INSERT INTO `yh_regions` VALUES (2294, 500119, 500100, '南川区', NULL);
INSERT INTO `yh_regions` VALUES (2295, 500120, 500100, '璧山区', NULL);
INSERT INTO `yh_regions` VALUES (2296, 500151, 500100, '铜梁区', NULL);
INSERT INTO `yh_regions` VALUES (2297, 500152, 500100, '潼南区', NULL);
INSERT INTO `yh_regions` VALUES (2298, 500153, 500100, '荣昌区', NULL);
INSERT INTO `yh_regions` VALUES (2299, 500154, 500100, '开州区', NULL);
INSERT INTO `yh_regions` VALUES (2300, 500155, 500100, '梁平区', NULL);
INSERT INTO `yh_regions` VALUES (2301, 500156, 500100, '武隆区', NULL);
INSERT INTO `yh_regions` VALUES (2302, 500229, 500200, '城口县', NULL);
INSERT INTO `yh_regions` VALUES (2303, 500230, 500200, '丰都县', NULL);
INSERT INTO `yh_regions` VALUES (2304, 500231, 500200, '垫江县', NULL);
INSERT INTO `yh_regions` VALUES (2305, 500233, 500200, '忠县', NULL);
INSERT INTO `yh_regions` VALUES (2306, 500235, 500200, '云阳县', NULL);
INSERT INTO `yh_regions` VALUES (2307, 500236, 500200, '奉节县', NULL);
INSERT INTO `yh_regions` VALUES (2308, 500237, 500200, '巫山县', NULL);
INSERT INTO `yh_regions` VALUES (2309, 500238, 500200, '巫溪县', NULL);
INSERT INTO `yh_regions` VALUES (2310, 500240, 500200, '石柱土家族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2311, 500241, 500200, '秀山土家族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2312, 500242, 500200, '酉阳土家族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2313, 500243, 500200, '彭水苗族土家族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2314, 510100, 510000, '成都市', NULL);
INSERT INTO `yh_regions` VALUES (2315, 510300, 510000, '自贡市', NULL);
INSERT INTO `yh_regions` VALUES (2316, 510400, 510000, '攀枝花市', NULL);
INSERT INTO `yh_regions` VALUES (2317, 510500, 510000, '泸州市', NULL);
INSERT INTO `yh_regions` VALUES (2318, 510600, 510000, '德阳市', NULL);
INSERT INTO `yh_regions` VALUES (2319, 510700, 510000, '绵阳市', NULL);
INSERT INTO `yh_regions` VALUES (2320, 510800, 510000, '广元市', NULL);
INSERT INTO `yh_regions` VALUES (2321, 510900, 510000, '遂宁市', NULL);
INSERT INTO `yh_regions` VALUES (2322, 511000, 510000, '内江市', NULL);
INSERT INTO `yh_regions` VALUES (2323, 511100, 510000, '乐山市', NULL);
INSERT INTO `yh_regions` VALUES (2324, 511300, 510000, '南充市', NULL);
INSERT INTO `yh_regions` VALUES (2325, 511400, 510000, '眉山市', NULL);
INSERT INTO `yh_regions` VALUES (2326, 511500, 510000, '宜宾市', NULL);
INSERT INTO `yh_regions` VALUES (2327, 511600, 510000, '广安市', NULL);
INSERT INTO `yh_regions` VALUES (2328, 511700, 510000, '达州市', NULL);
INSERT INTO `yh_regions` VALUES (2329, 511800, 510000, '雅安市', NULL);
INSERT INTO `yh_regions` VALUES (2330, 511900, 510000, '巴中市', NULL);
INSERT INTO `yh_regions` VALUES (2331, 512000, 510000, '资阳市', NULL);
INSERT INTO `yh_regions` VALUES (2332, 513200, 510000, '阿坝藏族羌族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2333, 513300, 510000, '甘孜藏族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2334, 513400, 510000, '凉山彝族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2335, 510104, 510100, '锦江区', NULL);
INSERT INTO `yh_regions` VALUES (2336, 510105, 510100, '青羊区', NULL);
INSERT INTO `yh_regions` VALUES (2337, 510106, 510100, '金牛区', NULL);
INSERT INTO `yh_regions` VALUES (2338, 510107, 510100, '武侯区', NULL);
INSERT INTO `yh_regions` VALUES (2339, 510108, 510100, '成华区', NULL);
INSERT INTO `yh_regions` VALUES (2340, 510112, 510100, '龙泉驿区', NULL);
INSERT INTO `yh_regions` VALUES (2341, 510113, 510100, '青白江区', NULL);
INSERT INTO `yh_regions` VALUES (2342, 510114, 510100, '新都区', NULL);
INSERT INTO `yh_regions` VALUES (2343, 510115, 510100, '温江区', NULL);
INSERT INTO `yh_regions` VALUES (2344, 510116, 510100, '双流区', NULL);
INSERT INTO `yh_regions` VALUES (2345, 510117, 510100, '郫都区', NULL);
INSERT INTO `yh_regions` VALUES (2346, 510121, 510100, '金堂县', NULL);
INSERT INTO `yh_regions` VALUES (2347, 510129, 510100, '大邑县', NULL);
INSERT INTO `yh_regions` VALUES (2348, 510131, 510100, '蒲江县', NULL);
INSERT INTO `yh_regions` VALUES (2349, 510132, 510100, '新津县', NULL);
INSERT INTO `yh_regions` VALUES (2350, 510181, 510100, '都江堰市', NULL);
INSERT INTO `yh_regions` VALUES (2351, 510182, 510100, '彭州市', NULL);
INSERT INTO `yh_regions` VALUES (2352, 510183, 510100, '邛崃市', NULL);
INSERT INTO `yh_regions` VALUES (2353, 510184, 510100, '崇州市', NULL);
INSERT INTO `yh_regions` VALUES (2354, 510185, 510100, '简阳市', NULL);
INSERT INTO `yh_regions` VALUES (2355, 510302, 510300, '自流井区', NULL);
INSERT INTO `yh_regions` VALUES (2356, 510303, 510300, '贡井区', NULL);
INSERT INTO `yh_regions` VALUES (2357, 510304, 510300, '大安区', NULL);
INSERT INTO `yh_regions` VALUES (2358, 510311, 510300, '沿滩区', NULL);
INSERT INTO `yh_regions` VALUES (2359, 510321, 510300, '荣县', NULL);
INSERT INTO `yh_regions` VALUES (2360, 510322, 510300, '富顺县', NULL);
INSERT INTO `yh_regions` VALUES (2361, 510402, 510400, '东区', NULL);
INSERT INTO `yh_regions` VALUES (2362, 510403, 510400, '西区', NULL);
INSERT INTO `yh_regions` VALUES (2363, 510411, 510400, '仁和区', NULL);
INSERT INTO `yh_regions` VALUES (2364, 510421, 510400, '米易县', NULL);
INSERT INTO `yh_regions` VALUES (2365, 510422, 510400, '盐边县', NULL);
INSERT INTO `yh_regions` VALUES (2366, 510502, 510500, '江阳区', NULL);
INSERT INTO `yh_regions` VALUES (2367, 510503, 510500, '纳溪区', NULL);
INSERT INTO `yh_regions` VALUES (2368, 510504, 510500, '龙马潭区', NULL);
INSERT INTO `yh_regions` VALUES (2369, 510521, 510500, '泸县', NULL);
INSERT INTO `yh_regions` VALUES (2370, 510522, 510500, '合江县', NULL);
INSERT INTO `yh_regions` VALUES (2371, 510524, 510500, '叙永县', NULL);
INSERT INTO `yh_regions` VALUES (2372, 510525, 510500, '古蔺县', NULL);
INSERT INTO `yh_regions` VALUES (2373, 510603, 510600, '旌阳区', NULL);
INSERT INTO `yh_regions` VALUES (2374, 510623, 510600, '中江县', NULL);
INSERT INTO `yh_regions` VALUES (2375, 510626, 510600, '罗江区', NULL);
INSERT INTO `yh_regions` VALUES (2376, 510681, 510600, '广汉市', NULL);
INSERT INTO `yh_regions` VALUES (2377, 510682, 510600, '什邡市', NULL);
INSERT INTO `yh_regions` VALUES (2378, 510683, 510600, '绵竹市', NULL);
INSERT INTO `yh_regions` VALUES (2379, 510703, 510700, '涪城区', NULL);
INSERT INTO `yh_regions` VALUES (2380, 510704, 510700, '游仙区', NULL);
INSERT INTO `yh_regions` VALUES (2381, 510705, 510700, '安州区', NULL);
INSERT INTO `yh_regions` VALUES (2382, 510722, 510700, '三台县', NULL);
INSERT INTO `yh_regions` VALUES (2383, 510723, 510700, '盐亭县', NULL);
INSERT INTO `yh_regions` VALUES (2384, 510725, 510700, '梓潼县', NULL);
INSERT INTO `yh_regions` VALUES (2385, 510726, 510700, '北川羌族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2386, 510727, 510700, '平武县', NULL);
INSERT INTO `yh_regions` VALUES (2387, 510781, 510700, '江油市', NULL);
INSERT INTO `yh_regions` VALUES (2388, 510802, 510800, '利州区', NULL);
INSERT INTO `yh_regions` VALUES (2389, 510811, 510800, '昭化区', NULL);
INSERT INTO `yh_regions` VALUES (2390, 510812, 510800, '朝天区', NULL);
INSERT INTO `yh_regions` VALUES (2391, 510821, 510800, '旺苍县', NULL);
INSERT INTO `yh_regions` VALUES (2392, 510822, 510800, '青川县', NULL);
INSERT INTO `yh_regions` VALUES (2393, 510823, 510800, '剑阁县', NULL);
INSERT INTO `yh_regions` VALUES (2394, 510824, 510800, '苍溪县', NULL);
INSERT INTO `yh_regions` VALUES (2395, 510903, 510900, '船山区', NULL);
INSERT INTO `yh_regions` VALUES (2396, 510904, 510900, '安居区', NULL);
INSERT INTO `yh_regions` VALUES (2397, 510921, 510900, '蓬溪县', NULL);
INSERT INTO `yh_regions` VALUES (2398, 510922, 510900, '射洪县', NULL);
INSERT INTO `yh_regions` VALUES (2399, 510923, 510900, '大英县', NULL);
INSERT INTO `yh_regions` VALUES (2400, 511002, 511000, '市中区', NULL);
INSERT INTO `yh_regions` VALUES (2401, 511011, 511000, '东兴区', NULL);
INSERT INTO `yh_regions` VALUES (2402, 511024, 511000, '威远县', NULL);
INSERT INTO `yh_regions` VALUES (2403, 511025, 511000, '资中县', NULL);
INSERT INTO `yh_regions` VALUES (2404, 511083, 511000, '隆昌市', NULL);
INSERT INTO `yh_regions` VALUES (2405, 511102, 511100, '市中区', NULL);
INSERT INTO `yh_regions` VALUES (2406, 511111, 511100, '沙湾区', NULL);
INSERT INTO `yh_regions` VALUES (2407, 511112, 511100, '五通桥区', NULL);
INSERT INTO `yh_regions` VALUES (2408, 511113, 511100, '金口河区', NULL);
INSERT INTO `yh_regions` VALUES (2409, 511123, 511100, '犍为县', NULL);
INSERT INTO `yh_regions` VALUES (2410, 511124, 511100, '井研县', NULL);
INSERT INTO `yh_regions` VALUES (2411, 511126, 511100, '夹江县', NULL);
INSERT INTO `yh_regions` VALUES (2412, 511129, 511100, '沐川县', NULL);
INSERT INTO `yh_regions` VALUES (2413, 511132, 511100, '峨边彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2414, 511133, 511100, '马边彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2415, 511181, 511100, '峨眉山市', NULL);
INSERT INTO `yh_regions` VALUES (2416, 511302, 511300, '顺庆区', NULL);
INSERT INTO `yh_regions` VALUES (2417, 511303, 511300, '高坪区', NULL);
INSERT INTO `yh_regions` VALUES (2418, 511304, 511300, '嘉陵区', NULL);
INSERT INTO `yh_regions` VALUES (2419, 511321, 511300, '南部县', NULL);
INSERT INTO `yh_regions` VALUES (2420, 511322, 511300, '营山县', NULL);
INSERT INTO `yh_regions` VALUES (2421, 511323, 511300, '蓬安县', NULL);
INSERT INTO `yh_regions` VALUES (2422, 511324, 511300, '仪陇县', NULL);
INSERT INTO `yh_regions` VALUES (2423, 511325, 511300, '西充县', NULL);
INSERT INTO `yh_regions` VALUES (2424, 511381, 511300, '阆中市', NULL);
INSERT INTO `yh_regions` VALUES (2425, 511402, 511400, '东坡区', NULL);
INSERT INTO `yh_regions` VALUES (2426, 511403, 511400, '彭山区', NULL);
INSERT INTO `yh_regions` VALUES (2427, 511421, 511400, '仁寿县', NULL);
INSERT INTO `yh_regions` VALUES (2428, 511423, 511400, '洪雅县', NULL);
INSERT INTO `yh_regions` VALUES (2429, 511424, 511400, '丹棱县', NULL);
INSERT INTO `yh_regions` VALUES (2430, 511425, 511400, '青神县', NULL);
INSERT INTO `yh_regions` VALUES (2431, 511502, 511500, '翠屏区', NULL);
INSERT INTO `yh_regions` VALUES (2432, 511503, 511500, '南溪区', NULL);
INSERT INTO `yh_regions` VALUES (2433, 511521, 511500, '宜宾县', NULL);
INSERT INTO `yh_regions` VALUES (2434, 511523, 511500, '江安县', NULL);
INSERT INTO `yh_regions` VALUES (2435, 511524, 511500, '长宁县', NULL);
INSERT INTO `yh_regions` VALUES (2436, 511525, 511500, '高县', NULL);
INSERT INTO `yh_regions` VALUES (2437, 511526, 511500, '珙县', NULL);
INSERT INTO `yh_regions` VALUES (2438, 511527, 511500, '筠连县', NULL);
INSERT INTO `yh_regions` VALUES (2439, 511528, 511500, '兴文县', NULL);
INSERT INTO `yh_regions` VALUES (2440, 511529, 511500, '屏山县', NULL);
INSERT INTO `yh_regions` VALUES (2441, 511602, 511600, '广安区', NULL);
INSERT INTO `yh_regions` VALUES (2442, 511603, 511600, '前锋区', NULL);
INSERT INTO `yh_regions` VALUES (2443, 511621, 511600, '岳池县', NULL);
INSERT INTO `yh_regions` VALUES (2444, 511622, 511600, '武胜县', NULL);
INSERT INTO `yh_regions` VALUES (2445, 511623, 511600, '邻水县', NULL);
INSERT INTO `yh_regions` VALUES (2446, 511681, 511600, '华蓥市', NULL);
INSERT INTO `yh_regions` VALUES (2447, 511702, 511700, '通川区', NULL);
INSERT INTO `yh_regions` VALUES (2448, 511703, 511700, '达川区', NULL);
INSERT INTO `yh_regions` VALUES (2449, 511722, 511700, '宣汉县', NULL);
INSERT INTO `yh_regions` VALUES (2450, 511723, 511700, '开江县', NULL);
INSERT INTO `yh_regions` VALUES (2451, 511724, 511700, '大竹县', NULL);
INSERT INTO `yh_regions` VALUES (2452, 511725, 511700, '渠县', NULL);
INSERT INTO `yh_regions` VALUES (2453, 511781, 511700, '万源市', NULL);
INSERT INTO `yh_regions` VALUES (2454, 511802, 511800, '雨城区', NULL);
INSERT INTO `yh_regions` VALUES (2455, 511803, 511800, '名山区', NULL);
INSERT INTO `yh_regions` VALUES (2456, 511822, 511800, '荥经县', NULL);
INSERT INTO `yh_regions` VALUES (2457, 511823, 511800, '汉源县', NULL);
INSERT INTO `yh_regions` VALUES (2458, 511824, 511800, '石棉县', NULL);
INSERT INTO `yh_regions` VALUES (2459, 511825, 511800, '天全县', NULL);
INSERT INTO `yh_regions` VALUES (2460, 511826, 511800, '芦山县', NULL);
INSERT INTO `yh_regions` VALUES (2461, 511827, 511800, '宝兴县', NULL);
INSERT INTO `yh_regions` VALUES (2462, 511902, 511900, '巴州区', NULL);
INSERT INTO `yh_regions` VALUES (2463, 511903, 511900, '恩阳区', NULL);
INSERT INTO `yh_regions` VALUES (2464, 511921, 511900, '通江县', NULL);
INSERT INTO `yh_regions` VALUES (2465, 511922, 511900, '南江县', NULL);
INSERT INTO `yh_regions` VALUES (2466, 511923, 511900, '平昌县', NULL);
INSERT INTO `yh_regions` VALUES (2467, 512002, 512000, '雁江区', NULL);
INSERT INTO `yh_regions` VALUES (2468, 512021, 512000, '安岳县', NULL);
INSERT INTO `yh_regions` VALUES (2469, 512022, 512000, '乐至县', NULL);
INSERT INTO `yh_regions` VALUES (2470, 513201, 513200, '马尔康市', NULL);
INSERT INTO `yh_regions` VALUES (2471, 513221, 513200, '汶川县', NULL);
INSERT INTO `yh_regions` VALUES (2472, 513222, 513200, '理县', NULL);
INSERT INTO `yh_regions` VALUES (2473, 513223, 513200, '茂县', NULL);
INSERT INTO `yh_regions` VALUES (2474, 513224, 513200, '松潘县', NULL);
INSERT INTO `yh_regions` VALUES (2475, 513225, 513200, '九寨沟市', NULL);
INSERT INTO `yh_regions` VALUES (2476, 513226, 513200, '金川县', NULL);
INSERT INTO `yh_regions` VALUES (2477, 513227, 513200, '小金县', NULL);
INSERT INTO `yh_regions` VALUES (2478, 513228, 513200, '黑水县', NULL);
INSERT INTO `yh_regions` VALUES (2479, 513230, 513200, '壤塘县', NULL);
INSERT INTO `yh_regions` VALUES (2480, 513231, 513200, '阿坝县', NULL);
INSERT INTO `yh_regions` VALUES (2481, 513232, 513200, '若尔盖县', NULL);
INSERT INTO `yh_regions` VALUES (2482, 513233, 513200, '红原县', NULL);
INSERT INTO `yh_regions` VALUES (2483, 513301, 513300, '康定市', NULL);
INSERT INTO `yh_regions` VALUES (2484, 513322, 513300, '泸定县', NULL);
INSERT INTO `yh_regions` VALUES (2485, 513323, 513300, '丹巴县', NULL);
INSERT INTO `yh_regions` VALUES (2486, 513324, 513300, '九龙县', NULL);
INSERT INTO `yh_regions` VALUES (2487, 513325, 513300, '雅江县', NULL);
INSERT INTO `yh_regions` VALUES (2488, 513326, 513300, '道孚县', NULL);
INSERT INTO `yh_regions` VALUES (2489, 513327, 513300, '炉霍县', NULL);
INSERT INTO `yh_regions` VALUES (2490, 513328, 513300, '甘孜县', NULL);
INSERT INTO `yh_regions` VALUES (2491, 513329, 513300, '新龙县', NULL);
INSERT INTO `yh_regions` VALUES (2492, 513330, 513300, '德格县', NULL);
INSERT INTO `yh_regions` VALUES (2493, 513331, 513300, '白玉县', NULL);
INSERT INTO `yh_regions` VALUES (2494, 513332, 513300, '石渠县', NULL);
INSERT INTO `yh_regions` VALUES (2495, 513333, 513300, '色达县', NULL);
INSERT INTO `yh_regions` VALUES (2496, 513334, 513300, '理塘县', NULL);
INSERT INTO `yh_regions` VALUES (2497, 513335, 513300, '巴塘县', NULL);
INSERT INTO `yh_regions` VALUES (2498, 513336, 513300, '乡城县', NULL);
INSERT INTO `yh_regions` VALUES (2499, 513337, 513300, '稻城县', NULL);
INSERT INTO `yh_regions` VALUES (2500, 513338, 513300, '得荣县', NULL);
INSERT INTO `yh_regions` VALUES (2501, 513401, 513400, '西昌市', NULL);
INSERT INTO `yh_regions` VALUES (2502, 513422, 513400, '木里藏族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2503, 513423, 513400, '盐源县', NULL);
INSERT INTO `yh_regions` VALUES (2504, 513424, 513400, '德昌县', NULL);
INSERT INTO `yh_regions` VALUES (2505, 513425, 513400, '会理县', NULL);
INSERT INTO `yh_regions` VALUES (2506, 513426, 513400, '会东县', NULL);
INSERT INTO `yh_regions` VALUES (2507, 513427, 513400, '宁南县', NULL);
INSERT INTO `yh_regions` VALUES (2508, 513428, 513400, '普格县', NULL);
INSERT INTO `yh_regions` VALUES (2509, 513429, 513400, '布拖县', NULL);
INSERT INTO `yh_regions` VALUES (2510, 513430, 513400, '金阳县', NULL);
INSERT INTO `yh_regions` VALUES (2511, 513431, 513400, '昭觉县', NULL);
INSERT INTO `yh_regions` VALUES (2512, 513432, 513400, '喜德县', NULL);
INSERT INTO `yh_regions` VALUES (2513, 513433, 513400, '冕宁县', NULL);
INSERT INTO `yh_regions` VALUES (2514, 513434, 513400, '越西县', NULL);
INSERT INTO `yh_regions` VALUES (2515, 513435, 513400, '甘洛县', NULL);
INSERT INTO `yh_regions` VALUES (2516, 513436, 513400, '美姑县', NULL);
INSERT INTO `yh_regions` VALUES (2517, 513437, 513400, '雷波县', NULL);
INSERT INTO `yh_regions` VALUES (2518, 520100, 520000, '贵阳市', NULL);
INSERT INTO `yh_regions` VALUES (2519, 520200, 520000, '六盘水市', NULL);
INSERT INTO `yh_regions` VALUES (2520, 520300, 520000, '遵义市', NULL);
INSERT INTO `yh_regions` VALUES (2521, 520400, 520000, '安顺市', NULL);
INSERT INTO `yh_regions` VALUES (2522, 520500, 520000, '毕节市', NULL);
INSERT INTO `yh_regions` VALUES (2523, 520600, 520000, '铜仁市', NULL);
INSERT INTO `yh_regions` VALUES (2524, 522300, 520000, '黔西南布依族苗族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2525, 522600, 520000, '黔东南苗族侗族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2526, 522700, 520000, '黔南布依族苗族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2527, 520102, 520100, '南明区', NULL);
INSERT INTO `yh_regions` VALUES (2528, 520103, 520100, '云岩区', NULL);
INSERT INTO `yh_regions` VALUES (2529, 520111, 520100, '花溪区', NULL);
INSERT INTO `yh_regions` VALUES (2530, 520112, 520100, '乌当区', NULL);
INSERT INTO `yh_regions` VALUES (2531, 520113, 520100, '白云区', NULL);
INSERT INTO `yh_regions` VALUES (2532, 520115, 520100, '观山湖区', NULL);
INSERT INTO `yh_regions` VALUES (2533, 520121, 520100, '开阳县', NULL);
INSERT INTO `yh_regions` VALUES (2534, 520122, 520100, '息烽县', NULL);
INSERT INTO `yh_regions` VALUES (2535, 520123, 520100, '修文县', NULL);
INSERT INTO `yh_regions` VALUES (2536, 520181, 520100, '清镇市', NULL);
INSERT INTO `yh_regions` VALUES (2537, 520201, 520200, '钟山区', NULL);
INSERT INTO `yh_regions` VALUES (2538, 520203, 520200, '六枝特区', NULL);
INSERT INTO `yh_regions` VALUES (2539, 520221, 520200, '水城县', NULL);
INSERT INTO `yh_regions` VALUES (2540, 520281, 520200, '盘州市', NULL);
INSERT INTO `yh_regions` VALUES (2541, 520302, 520300, '红花岗区', NULL);
INSERT INTO `yh_regions` VALUES (2542, 520303, 520300, '汇川区', NULL);
INSERT INTO `yh_regions` VALUES (2543, 520304, 520300, '播州区', NULL);
INSERT INTO `yh_regions` VALUES (2544, 520322, 520300, '桐梓县', NULL);
INSERT INTO `yh_regions` VALUES (2545, 520323, 520300, '绥阳县', NULL);
INSERT INTO `yh_regions` VALUES (2546, 520324, 520300, '正安县', NULL);
INSERT INTO `yh_regions` VALUES (2547, 520325, 520300, '道真仡佬族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2548, 520326, 520300, '务川仡佬族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2549, 520327, 520300, '凤冈县', NULL);
INSERT INTO `yh_regions` VALUES (2550, 520328, 520300, '湄潭县', NULL);
INSERT INTO `yh_regions` VALUES (2551, 520329, 520300, '余庆县', NULL);
INSERT INTO `yh_regions` VALUES (2552, 520330, 520300, '习水县', NULL);
INSERT INTO `yh_regions` VALUES (2553, 520381, 520300, '赤水市', NULL);
INSERT INTO `yh_regions` VALUES (2554, 520382, 520300, '仁怀市', NULL);
INSERT INTO `yh_regions` VALUES (2555, 520402, 520400, '西秀区', NULL);
INSERT INTO `yh_regions` VALUES (2556, 520403, 520400, '平坝区', NULL);
INSERT INTO `yh_regions` VALUES (2557, 520422, 520400, '普定县', NULL);
INSERT INTO `yh_regions` VALUES (2558, 520423, 520400, '镇宁布依族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2559, 520424, 520400, '关岭布依族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2560, 520425, 520400, '紫云苗族布依族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2561, 520502, 520500, '七星关区', NULL);
INSERT INTO `yh_regions` VALUES (2562, 520521, 520500, '大方县', NULL);
INSERT INTO `yh_regions` VALUES (2563, 520522, 520500, '黔西县', NULL);
INSERT INTO `yh_regions` VALUES (2564, 520523, 520500, '金沙县', NULL);
INSERT INTO `yh_regions` VALUES (2565, 520524, 520500, '织金县', NULL);
INSERT INTO `yh_regions` VALUES (2566, 520525, 520500, '纳雍县', NULL);
INSERT INTO `yh_regions` VALUES (2567, 520526, 520500, '威宁彝族回族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2568, 520527, 520500, '赫章县', NULL);
INSERT INTO `yh_regions` VALUES (2569, 520602, 520600, '碧江区', NULL);
INSERT INTO `yh_regions` VALUES (2570, 520603, 520600, '万山区', NULL);
INSERT INTO `yh_regions` VALUES (2571, 520621, 520600, '江口县', NULL);
INSERT INTO `yh_regions` VALUES (2572, 520622, 520600, '玉屏侗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2573, 520623, 520600, '石阡县', NULL);
INSERT INTO `yh_regions` VALUES (2574, 520624, 520600, '思南县', NULL);
INSERT INTO `yh_regions` VALUES (2575, 520625, 520600, '印江土家族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2576, 520626, 520600, '德江县', NULL);
INSERT INTO `yh_regions` VALUES (2577, 520627, 520600, '沿河土家族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2578, 520628, 520600, '松桃苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2579, 522301, 522300, '兴义市', NULL);
INSERT INTO `yh_regions` VALUES (2580, 522322, 522300, '兴仁县', NULL);
INSERT INTO `yh_regions` VALUES (2581, 522323, 522300, '普安县', NULL);
INSERT INTO `yh_regions` VALUES (2582, 522324, 522300, '晴隆县', NULL);
INSERT INTO `yh_regions` VALUES (2583, 522325, 522300, '贞丰县', NULL);
INSERT INTO `yh_regions` VALUES (2584, 522326, 522300, '望谟县', NULL);
INSERT INTO `yh_regions` VALUES (2585, 522327, 522300, '册亨县', NULL);
INSERT INTO `yh_regions` VALUES (2586, 522328, 522300, '安龙县', NULL);
INSERT INTO `yh_regions` VALUES (2587, 522601, 522600, '凯里市', NULL);
INSERT INTO `yh_regions` VALUES (2588, 522622, 522600, '黄平县', NULL);
INSERT INTO `yh_regions` VALUES (2589, 522623, 522600, '施秉县', NULL);
INSERT INTO `yh_regions` VALUES (2590, 522624, 522600, '三穗县', NULL);
INSERT INTO `yh_regions` VALUES (2591, 522625, 522600, '镇远县', NULL);
INSERT INTO `yh_regions` VALUES (2592, 522626, 522600, '岑巩县', NULL);
INSERT INTO `yh_regions` VALUES (2593, 522627, 522600, '天柱县', NULL);
INSERT INTO `yh_regions` VALUES (2594, 522628, 522600, '锦屏县', NULL);
INSERT INTO `yh_regions` VALUES (2595, 522629, 522600, '剑河县', NULL);
INSERT INTO `yh_regions` VALUES (2596, 522630, 522600, '台江县', NULL);
INSERT INTO `yh_regions` VALUES (2597, 522631, 522600, '黎平县', NULL);
INSERT INTO `yh_regions` VALUES (2598, 522632, 522600, '榕江县', NULL);
INSERT INTO `yh_regions` VALUES (2599, 522633, 522600, '从江县', NULL);
INSERT INTO `yh_regions` VALUES (2600, 522634, 522600, '雷山县', NULL);
INSERT INTO `yh_regions` VALUES (2601, 522635, 522600, '麻江县', NULL);
INSERT INTO `yh_regions` VALUES (2602, 522636, 522600, '丹寨县', NULL);
INSERT INTO `yh_regions` VALUES (2603, 522701, 522700, '都匀市', NULL);
INSERT INTO `yh_regions` VALUES (2604, 522702, 522700, '福泉市', NULL);
INSERT INTO `yh_regions` VALUES (2605, 522722, 522700, '荔波县', NULL);
INSERT INTO `yh_regions` VALUES (2606, 522723, 522700, '贵定县', NULL);
INSERT INTO `yh_regions` VALUES (2607, 522725, 522700, '瓮安县', NULL);
INSERT INTO `yh_regions` VALUES (2608, 522726, 522700, '独山县', NULL);
INSERT INTO `yh_regions` VALUES (2609, 522727, 522700, '平塘县', NULL);
INSERT INTO `yh_regions` VALUES (2610, 522728, 522700, '罗甸县', NULL);
INSERT INTO `yh_regions` VALUES (2611, 522729, 522700, '长顺县', NULL);
INSERT INTO `yh_regions` VALUES (2612, 522730, 522700, '龙里县', NULL);
INSERT INTO `yh_regions` VALUES (2613, 522731, 522700, '惠水县', NULL);
INSERT INTO `yh_regions` VALUES (2614, 522732, 522700, '三都水族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2615, 530100, 530000, '昆明市', NULL);
INSERT INTO `yh_regions` VALUES (2616, 530300, 530000, '曲靖市', NULL);
INSERT INTO `yh_regions` VALUES (2617, 530400, 530000, '玉溪市', NULL);
INSERT INTO `yh_regions` VALUES (2618, 530500, 530000, '保山市', NULL);
INSERT INTO `yh_regions` VALUES (2619, 530600, 530000, '昭通市', NULL);
INSERT INTO `yh_regions` VALUES (2620, 530700, 530000, '丽江市', NULL);
INSERT INTO `yh_regions` VALUES (2621, 530800, 530000, '普洱市', NULL);
INSERT INTO `yh_regions` VALUES (2622, 530900, 530000, '临沧市', NULL);
INSERT INTO `yh_regions` VALUES (2623, 532300, 530000, '楚雄彝族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2624, 532500, 530000, '红河哈尼族彝族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2625, 532600, 530000, '文山壮族苗族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2626, 532800, 530000, '西双版纳傣族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2627, 532900, 530000, '大理白族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2628, 533100, 530000, '德宏傣族景颇族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2629, 533300, 530000, '怒江傈僳族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2630, 533400, 530000, '迪庆藏族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2631, 530102, 530100, '五华区', NULL);
INSERT INTO `yh_regions` VALUES (2632, 530103, 530100, '盘龙区', NULL);
INSERT INTO `yh_regions` VALUES (2633, 530111, 530100, '官渡区', NULL);
INSERT INTO `yh_regions` VALUES (2634, 530112, 530100, '西山区', NULL);
INSERT INTO `yh_regions` VALUES (2635, 530113, 530100, '东川区', NULL);
INSERT INTO `yh_regions` VALUES (2636, 530114, 530100, '呈贡区', NULL);
INSERT INTO `yh_regions` VALUES (2637, 530115, 530100, '晋宁区', NULL);
INSERT INTO `yh_regions` VALUES (2638, 530124, 530100, '富民县', NULL);
INSERT INTO `yh_regions` VALUES (2639, 530125, 530100, '宜良县', NULL);
INSERT INTO `yh_regions` VALUES (2640, 530126, 530100, '石林彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2641, 530127, 530100, '嵩明县', NULL);
INSERT INTO `yh_regions` VALUES (2642, 530128, 530100, '禄劝彝族苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2643, 530129, 530100, '寻甸回族彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2644, 530181, 530100, '安宁市', NULL);
INSERT INTO `yh_regions` VALUES (2645, 530302, 530300, '麒麟区', NULL);
INSERT INTO `yh_regions` VALUES (2646, 530303, 530300, '沾益区', NULL);
INSERT INTO `yh_regions` VALUES (2647, 530321, 530300, '马龙县', NULL);
INSERT INTO `yh_regions` VALUES (2648, 530322, 530300, '陆良县', NULL);
INSERT INTO `yh_regions` VALUES (2649, 530323, 530300, '师宗县', NULL);
INSERT INTO `yh_regions` VALUES (2650, 530324, 530300, '罗平县', NULL);
INSERT INTO `yh_regions` VALUES (2651, 530325, 530300, '富源县', NULL);
INSERT INTO `yh_regions` VALUES (2652, 530326, 530300, '会泽县', NULL);
INSERT INTO `yh_regions` VALUES (2653, 530381, 530300, '宣威市', NULL);
INSERT INTO `yh_regions` VALUES (2654, 530402, 530400, '红塔区', NULL);
INSERT INTO `yh_regions` VALUES (2655, 530403, 530400, '江川区', NULL);
INSERT INTO `yh_regions` VALUES (2656, 530422, 530400, '澄江县', NULL);
INSERT INTO `yh_regions` VALUES (2657, 530423, 530400, '通海县', NULL);
INSERT INTO `yh_regions` VALUES (2658, 530424, 530400, '华宁县', NULL);
INSERT INTO `yh_regions` VALUES (2659, 530425, 530400, '易门县', NULL);
INSERT INTO `yh_regions` VALUES (2660, 530426, 530400, '峨山彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2661, 530427, 530400, '新平彝族傣族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2662, 530428, 530400, '元江哈尼族彝族傣族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2663, 530502, 530500, '隆阳区', NULL);
INSERT INTO `yh_regions` VALUES (2664, 530521, 530500, '施甸县', NULL);
INSERT INTO `yh_regions` VALUES (2665, 530523, 530500, '龙陵县', NULL);
INSERT INTO `yh_regions` VALUES (2666, 530524, 530500, '昌宁县', NULL);
INSERT INTO `yh_regions` VALUES (2667, 530581, 530500, '腾冲市', NULL);
INSERT INTO `yh_regions` VALUES (2668, 530602, 530600, '昭阳区', NULL);
INSERT INTO `yh_regions` VALUES (2669, 530621, 530600, '鲁甸县', NULL);
INSERT INTO `yh_regions` VALUES (2670, 530622, 530600, '巧家县', NULL);
INSERT INTO `yh_regions` VALUES (2671, 530623, 530600, '盐津县', NULL);
INSERT INTO `yh_regions` VALUES (2672, 530624, 530600, '大关县', NULL);
INSERT INTO `yh_regions` VALUES (2673, 530625, 530600, '永善县', NULL);
INSERT INTO `yh_regions` VALUES (2674, 530626, 530600, '绥江县', NULL);
INSERT INTO `yh_regions` VALUES (2675, 530627, 530600, '镇雄县', NULL);
INSERT INTO `yh_regions` VALUES (2676, 530628, 530600, '彝良县', NULL);
INSERT INTO `yh_regions` VALUES (2677, 530629, 530600, '威信县', NULL);
INSERT INTO `yh_regions` VALUES (2678, 530630, 530600, '水富县', NULL);
INSERT INTO `yh_regions` VALUES (2679, 530702, 530700, '古城区', NULL);
INSERT INTO `yh_regions` VALUES (2680, 530721, 530700, '玉龙纳西族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2681, 530722, 530700, '永胜县', NULL);
INSERT INTO `yh_regions` VALUES (2682, 530723, 530700, '华坪县', NULL);
INSERT INTO `yh_regions` VALUES (2683, 530724, 530700, '宁蒗彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2684, 530802, 530800, '思茅区', NULL);
INSERT INTO `yh_regions` VALUES (2685, 530821, 530800, '宁洱哈尼族彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2686, 530822, 530800, '墨江哈尼族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2687, 530823, 530800, '景东彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2688, 530824, 530800, '景谷傣族彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2689, 530825, 530800, '镇沅彝族哈尼族拉祜族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2690, 530826, 530800, '江城哈尼族彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2691, 530827, 530800, '孟连傣族拉祜族佤族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2692, 530828, 530800, '澜沧拉祜族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2693, 530829, 530800, '西盟佤族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2694, 530902, 530900, '临翔区', NULL);
INSERT INTO `yh_regions` VALUES (2695, 530921, 530900, '凤庆县', NULL);
INSERT INTO `yh_regions` VALUES (2696, 530922, 530900, '云县', NULL);
INSERT INTO `yh_regions` VALUES (2697, 530923, 530900, '永德县', NULL);
INSERT INTO `yh_regions` VALUES (2698, 530924, 530900, '镇康县', NULL);
INSERT INTO `yh_regions` VALUES (2699, 530925, 530900, '双江拉祜族佤族布朗族傣族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2700, 530926, 530900, '耿马傣族佤族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2701, 530927, 530900, '沧源佤族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2702, 532301, 532300, '楚雄市', NULL);
INSERT INTO `yh_regions` VALUES (2703, 532322, 532300, '双柏县', NULL);
INSERT INTO `yh_regions` VALUES (2704, 532323, 532300, '牟定县', NULL);
INSERT INTO `yh_regions` VALUES (2705, 532324, 532300, '南华县', NULL);
INSERT INTO `yh_regions` VALUES (2706, 532325, 532300, '姚安县', NULL);
INSERT INTO `yh_regions` VALUES (2707, 532326, 532300, '大姚县', NULL);
INSERT INTO `yh_regions` VALUES (2708, 532327, 532300, '永仁县', NULL);
INSERT INTO `yh_regions` VALUES (2709, 532328, 532300, '元谋县', NULL);
INSERT INTO `yh_regions` VALUES (2710, 532329, 532300, '武定县', NULL);
INSERT INTO `yh_regions` VALUES (2711, 532331, 532300, '禄丰县', NULL);
INSERT INTO `yh_regions` VALUES (2712, 532501, 532500, '个旧市', NULL);
INSERT INTO `yh_regions` VALUES (2713, 532502, 532500, '开远市', NULL);
INSERT INTO `yh_regions` VALUES (2714, 532503, 532500, '蒙自市', NULL);
INSERT INTO `yh_regions` VALUES (2715, 532504, 532500, '弥勒市', NULL);
INSERT INTO `yh_regions` VALUES (2716, 532523, 532500, '屏边苗族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2717, 532524, 532500, '建水县', NULL);
INSERT INTO `yh_regions` VALUES (2718, 532525, 532500, '石屏县', NULL);
INSERT INTO `yh_regions` VALUES (2719, 532527, 532500, '泸西县', NULL);
INSERT INTO `yh_regions` VALUES (2720, 532528, 532500, '元阳县', NULL);
INSERT INTO `yh_regions` VALUES (2721, 532529, 532500, '红河县', NULL);
INSERT INTO `yh_regions` VALUES (2722, 532530, 532500, '金平苗族瑶族傣族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2723, 532531, 532500, '绿春县', NULL);
INSERT INTO `yh_regions` VALUES (2724, 532532, 532500, '河口瑶族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2725, 532601, 532600, '文山市', NULL);
INSERT INTO `yh_regions` VALUES (2726, 532622, 532600, '砚山县', NULL);
INSERT INTO `yh_regions` VALUES (2727, 532623, 532600, '西畴县', NULL);
INSERT INTO `yh_regions` VALUES (2728, 532624, 532600, '麻栗坡县', NULL);
INSERT INTO `yh_regions` VALUES (2729, 532625, 532600, '马关县', NULL);
INSERT INTO `yh_regions` VALUES (2730, 532626, 532600, '丘北县', NULL);
INSERT INTO `yh_regions` VALUES (2731, 532627, 532600, '广南县', NULL);
INSERT INTO `yh_regions` VALUES (2732, 532628, 532600, '富宁县', NULL);
INSERT INTO `yh_regions` VALUES (2733, 532801, 532800, '景洪市', NULL);
INSERT INTO `yh_regions` VALUES (2734, 532822, 532800, '勐海县', NULL);
INSERT INTO `yh_regions` VALUES (2735, 532823, 532800, '勐腊县', NULL);
INSERT INTO `yh_regions` VALUES (2736, 532901, 532900, '大理市', NULL);
INSERT INTO `yh_regions` VALUES (2737, 532922, 532900, '漾濞彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2738, 532923, 532900, '祥云县', NULL);
INSERT INTO `yh_regions` VALUES (2739, 532924, 532900, '宾川县', NULL);
INSERT INTO `yh_regions` VALUES (2740, 532925, 532900, '弥渡县', NULL);
INSERT INTO `yh_regions` VALUES (2741, 532926, 532900, '南涧彝族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2742, 532927, 532900, '巍山彝族回族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2743, 532928, 532900, '永平县', NULL);
INSERT INTO `yh_regions` VALUES (2744, 532929, 532900, '云龙县', NULL);
INSERT INTO `yh_regions` VALUES (2745, 532930, 532900, '洱源县', NULL);
INSERT INTO `yh_regions` VALUES (2746, 532931, 532900, '剑川县', NULL);
INSERT INTO `yh_regions` VALUES (2747, 532932, 532900, '鹤庆县', NULL);
INSERT INTO `yh_regions` VALUES (2748, 533102, 533100, '瑞丽市', NULL);
INSERT INTO `yh_regions` VALUES (2749, 533103, 533100, '芒市', NULL);
INSERT INTO `yh_regions` VALUES (2750, 533122, 533100, '梁河县', NULL);
INSERT INTO `yh_regions` VALUES (2751, 533123, 533100, '盈江县', NULL);
INSERT INTO `yh_regions` VALUES (2752, 533124, 533100, '陇川县', NULL);
INSERT INTO `yh_regions` VALUES (2753, 533301, 533300, '泸水市', NULL);
INSERT INTO `yh_regions` VALUES (2754, 533323, 533300, '福贡县', NULL);
INSERT INTO `yh_regions` VALUES (2755, 533324, 533300, '贡山独龙族怒族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2756, 533325, 533300, '兰坪白族普米族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2757, 533401, 533400, '香格里拉市', NULL);
INSERT INTO `yh_regions` VALUES (2758, 533422, 533400, '德钦县', NULL);
INSERT INTO `yh_regions` VALUES (2759, 533423, 533400, '维西傈僳族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2760, 540100, 540000, '拉萨市', NULL);
INSERT INTO `yh_regions` VALUES (2761, 540200, 540000, '日喀则市', NULL);
INSERT INTO `yh_regions` VALUES (2762, 540300, 540000, '昌都市', NULL);
INSERT INTO `yh_regions` VALUES (2763, 540400, 540000, '林芝市', NULL);
INSERT INTO `yh_regions` VALUES (2764, 540500, 540000, '山南市', NULL);
INSERT INTO `yh_regions` VALUES (2765, 540600, 540000, '那曲市', NULL);
INSERT INTO `yh_regions` VALUES (2766, 542500, 540000, '阿里地区', NULL);
INSERT INTO `yh_regions` VALUES (2767, 540102, 540100, '城关区', NULL);
INSERT INTO `yh_regions` VALUES (2768, 540103, 540100, '堆龙德庆区', NULL);
INSERT INTO `yh_regions` VALUES (2769, 540104, 540100, '达孜区', NULL);
INSERT INTO `yh_regions` VALUES (2770, 540121, 540100, '林周县', NULL);
INSERT INTO `yh_regions` VALUES (2771, 540122, 540100, '当雄县', NULL);
INSERT INTO `yh_regions` VALUES (2772, 540123, 540100, '尼木县', NULL);
INSERT INTO `yh_regions` VALUES (2773, 540124, 540100, '曲水县', NULL);
INSERT INTO `yh_regions` VALUES (2774, 540127, 540100, '墨竹工卡县', NULL);
INSERT INTO `yh_regions` VALUES (2775, 540202, 540200, '桑珠孜区', NULL);
INSERT INTO `yh_regions` VALUES (2776, 540221, 540200, '南木林县', NULL);
INSERT INTO `yh_regions` VALUES (2777, 540222, 540200, '江孜县', NULL);
INSERT INTO `yh_regions` VALUES (2778, 540223, 540200, '定日县', NULL);
INSERT INTO `yh_regions` VALUES (2779, 540224, 540200, '萨迦县', NULL);
INSERT INTO `yh_regions` VALUES (2780, 540225, 540200, '拉孜县', NULL);
INSERT INTO `yh_regions` VALUES (2781, 540226, 540200, '昂仁县', NULL);
INSERT INTO `yh_regions` VALUES (2782, 540227, 540200, '谢通门县', NULL);
INSERT INTO `yh_regions` VALUES (2783, 540228, 540200, '白朗县', NULL);
INSERT INTO `yh_regions` VALUES (2784, 540229, 540200, '仁布县', NULL);
INSERT INTO `yh_regions` VALUES (2785, 540230, 540200, '康马县', NULL);
INSERT INTO `yh_regions` VALUES (2786, 540231, 540200, '定结县', NULL);
INSERT INTO `yh_regions` VALUES (2787, 540232, 540200, '仲巴县', NULL);
INSERT INTO `yh_regions` VALUES (2788, 540233, 540200, '亚东县', NULL);
INSERT INTO `yh_regions` VALUES (2789, 540234, 540200, '吉隆县', NULL);
INSERT INTO `yh_regions` VALUES (2790, 540235, 540200, '聂拉木县', NULL);
INSERT INTO `yh_regions` VALUES (2791, 540236, 540200, '萨嘎县', NULL);
INSERT INTO `yh_regions` VALUES (2792, 540237, 540200, '岗巴县', NULL);
INSERT INTO `yh_regions` VALUES (2793, 540302, 540300, '卡若区', NULL);
INSERT INTO `yh_regions` VALUES (2794, 540321, 540300, '江达县', NULL);
INSERT INTO `yh_regions` VALUES (2795, 540322, 540300, '贡觉县', NULL);
INSERT INTO `yh_regions` VALUES (2796, 540323, 540300, '类乌齐县', NULL);
INSERT INTO `yh_regions` VALUES (2797, 540324, 540300, '丁青县', NULL);
INSERT INTO `yh_regions` VALUES (2798, 540325, 540300, '察雅县', NULL);
INSERT INTO `yh_regions` VALUES (2799, 540326, 540300, '八宿县', NULL);
INSERT INTO `yh_regions` VALUES (2800, 540327, 540300, '左贡县', NULL);
INSERT INTO `yh_regions` VALUES (2801, 540328, 540300, '芒康县', NULL);
INSERT INTO `yh_regions` VALUES (2802, 540329, 540300, '洛隆县', NULL);
INSERT INTO `yh_regions` VALUES (2803, 540330, 540300, '边坝县', NULL);
INSERT INTO `yh_regions` VALUES (2804, 540402, 540400, '巴宜区', NULL);
INSERT INTO `yh_regions` VALUES (2805, 540421, 540400, '工布江达县', NULL);
INSERT INTO `yh_regions` VALUES (2806, 540422, 540400, '米林县', NULL);
INSERT INTO `yh_regions` VALUES (2807, 540423, 540400, '墨脱县', NULL);
INSERT INTO `yh_regions` VALUES (2808, 540424, 540400, '波密县', NULL);
INSERT INTO `yh_regions` VALUES (2809, 540425, 540400, '察隅县', NULL);
INSERT INTO `yh_regions` VALUES (2810, 540426, 540400, '朗县', NULL);
INSERT INTO `yh_regions` VALUES (2811, 540502, 540500, '乃东区', NULL);
INSERT INTO `yh_regions` VALUES (2812, 540521, 540500, '扎囊县', NULL);
INSERT INTO `yh_regions` VALUES (2813, 540522, 540500, '贡嘎县', NULL);
INSERT INTO `yh_regions` VALUES (2814, 540523, 540500, '桑日县', NULL);
INSERT INTO `yh_regions` VALUES (2815, 540524, 540500, '琼结县', NULL);
INSERT INTO `yh_regions` VALUES (2816, 540525, 540500, '曲松县', NULL);
INSERT INTO `yh_regions` VALUES (2817, 540526, 540500, '措美县', NULL);
INSERT INTO `yh_regions` VALUES (2818, 540527, 540500, '洛扎县', NULL);
INSERT INTO `yh_regions` VALUES (2819, 540528, 540500, '加查县', NULL);
INSERT INTO `yh_regions` VALUES (2820, 540529, 540500, '隆子县', NULL);
INSERT INTO `yh_regions` VALUES (2821, 540530, 540500, '错那县', NULL);
INSERT INTO `yh_regions` VALUES (2822, 540531, 540500, '浪卡子县', NULL);
INSERT INTO `yh_regions` VALUES (2823, 540602, 540600, '色尼区', NULL);
INSERT INTO `yh_regions` VALUES (2824, 540621, 540600, '嘉黎县', NULL);
INSERT INTO `yh_regions` VALUES (2825, 540622, 540600, '比如县', NULL);
INSERT INTO `yh_regions` VALUES (2826, 540623, 540600, '聂荣县', NULL);
INSERT INTO `yh_regions` VALUES (2827, 540624, 540600, '安多县', NULL);
INSERT INTO `yh_regions` VALUES (2828, 540625, 540600, '申扎县', NULL);
INSERT INTO `yh_regions` VALUES (2829, 540626, 540600, '索县', NULL);
INSERT INTO `yh_regions` VALUES (2830, 540627, 540600, '班戈县', NULL);
INSERT INTO `yh_regions` VALUES (2831, 540628, 540600, '巴青县', NULL);
INSERT INTO `yh_regions` VALUES (2832, 540629, 540600, '尼玛县', NULL);
INSERT INTO `yh_regions` VALUES (2833, 540630, 540600, '双湖县', NULL);
INSERT INTO `yh_regions` VALUES (2834, 542521, 542500, '普兰县', NULL);
INSERT INTO `yh_regions` VALUES (2835, 542522, 542500, '札达县', NULL);
INSERT INTO `yh_regions` VALUES (2836, 542523, 542500, '噶尔县', NULL);
INSERT INTO `yh_regions` VALUES (2837, 542524, 542500, '日土县', NULL);
INSERT INTO `yh_regions` VALUES (2838, 542525, 542500, '革吉县', NULL);
INSERT INTO `yh_regions` VALUES (2839, 542526, 542500, '改则县', NULL);
INSERT INTO `yh_regions` VALUES (2840, 542527, 542500, '措勤县', NULL);
INSERT INTO `yh_regions` VALUES (2841, 610100, 610000, '西安市', NULL);
INSERT INTO `yh_regions` VALUES (2842, 610200, 610000, '铜川市', NULL);
INSERT INTO `yh_regions` VALUES (2843, 610300, 610000, '宝鸡市', NULL);
INSERT INTO `yh_regions` VALUES (2844, 610400, 610000, '咸阳市', NULL);
INSERT INTO `yh_regions` VALUES (2845, 610500, 610000, '渭南市', NULL);
INSERT INTO `yh_regions` VALUES (2846, 610600, 610000, '延安市', NULL);
INSERT INTO `yh_regions` VALUES (2847, 610700, 610000, '汉中市', NULL);
INSERT INTO `yh_regions` VALUES (2848, 610800, 610000, '榆林市', NULL);
INSERT INTO `yh_regions` VALUES (2849, 610900, 610000, '安康市', NULL);
INSERT INTO `yh_regions` VALUES (2850, 611000, 610000, '商洛市', NULL);
INSERT INTO `yh_regions` VALUES (2851, 610102, 610100, '新城区', NULL);
INSERT INTO `yh_regions` VALUES (2852, 610103, 610100, '碑林区', NULL);
INSERT INTO `yh_regions` VALUES (2853, 610104, 610100, '莲湖区', NULL);
INSERT INTO `yh_regions` VALUES (2854, 610111, 610100, '灞桥区', NULL);
INSERT INTO `yh_regions` VALUES (2855, 610112, 610100, '未央区', NULL);
INSERT INTO `yh_regions` VALUES (2856, 610113, 610100, '雁塔区', NULL);
INSERT INTO `yh_regions` VALUES (2857, 610114, 610100, '阎良区', NULL);
INSERT INTO `yh_regions` VALUES (2858, 610115, 610100, '临潼区', NULL);
INSERT INTO `yh_regions` VALUES (2859, 610116, 610100, '长安区', NULL);
INSERT INTO `yh_regions` VALUES (2860, 610117, 610100, '高陵区', NULL);
INSERT INTO `yh_regions` VALUES (2861, 610118, 610100, '鄠邑区', NULL);
INSERT INTO `yh_regions` VALUES (2862, 610122, 610100, '蓝田县', NULL);
INSERT INTO `yh_regions` VALUES (2863, 610124, 610100, '周至县', NULL);
INSERT INTO `yh_regions` VALUES (2864, 610202, 610200, '王益区', NULL);
INSERT INTO `yh_regions` VALUES (2865, 610203, 610200, '印台区', NULL);
INSERT INTO `yh_regions` VALUES (2866, 610204, 610200, '耀州区', NULL);
INSERT INTO `yh_regions` VALUES (2867, 610222, 610200, '宜君县', NULL);
INSERT INTO `yh_regions` VALUES (2868, 610302, 610300, '渭滨区', NULL);
INSERT INTO `yh_regions` VALUES (2869, 610303, 610300, '金台区', NULL);
INSERT INTO `yh_regions` VALUES (2870, 610304, 610300, '陈仓区', NULL);
INSERT INTO `yh_regions` VALUES (2871, 610322, 610300, '凤翔县', NULL);
INSERT INTO `yh_regions` VALUES (2872, 610323, 610300, '岐山县', NULL);
INSERT INTO `yh_regions` VALUES (2873, 610324, 610300, '扶风县', NULL);
INSERT INTO `yh_regions` VALUES (2874, 610326, 610300, '眉县', NULL);
INSERT INTO `yh_regions` VALUES (2875, 610327, 610300, '陇县', NULL);
INSERT INTO `yh_regions` VALUES (2876, 610328, 610300, '千阳县', NULL);
INSERT INTO `yh_regions` VALUES (2877, 610329, 610300, '麟游县', NULL);
INSERT INTO `yh_regions` VALUES (2878, 610330, 610300, '凤县', NULL);
INSERT INTO `yh_regions` VALUES (2879, 610331, 610300, '太白县', NULL);
INSERT INTO `yh_regions` VALUES (2880, 610402, 610400, '秦都区', NULL);
INSERT INTO `yh_regions` VALUES (2881, 610403, 610400, '杨陵区', NULL);
INSERT INTO `yh_regions` VALUES (2882, 610404, 610400, '渭城区', NULL);
INSERT INTO `yh_regions` VALUES (2883, 610422, 610400, '三原县', NULL);
INSERT INTO `yh_regions` VALUES (2884, 610423, 610400, '泾阳县', NULL);
INSERT INTO `yh_regions` VALUES (2885, 610424, 610400, '乾县', NULL);
INSERT INTO `yh_regions` VALUES (2886, 610425, 610400, '礼泉县', NULL);
INSERT INTO `yh_regions` VALUES (2887, 610426, 610400, '永寿县', NULL);
INSERT INTO `yh_regions` VALUES (2888, 610427, 610400, '彬县', NULL);
INSERT INTO `yh_regions` VALUES (2889, 610428, 610400, '长武县', NULL);
INSERT INTO `yh_regions` VALUES (2890, 610429, 610400, '旬邑县', NULL);
INSERT INTO `yh_regions` VALUES (2891, 610430, 610400, '淳化县', NULL);
INSERT INTO `yh_regions` VALUES (2892, 610431, 610400, '武功县', NULL);
INSERT INTO `yh_regions` VALUES (2893, 610481, 610400, '兴平市', NULL);
INSERT INTO `yh_regions` VALUES (2894, 610502, 610500, '临渭区', NULL);
INSERT INTO `yh_regions` VALUES (2895, 610503, 610500, '华州区', NULL);
INSERT INTO `yh_regions` VALUES (2896, 610522, 610500, '潼关县', NULL);
INSERT INTO `yh_regions` VALUES (2897, 610523, 610500, '大荔县', NULL);
INSERT INTO `yh_regions` VALUES (2898, 610524, 610500, '合阳县', NULL);
INSERT INTO `yh_regions` VALUES (2899, 610525, 610500, '澄城县', NULL);
INSERT INTO `yh_regions` VALUES (2900, 610526, 610500, '蒲城县', NULL);
INSERT INTO `yh_regions` VALUES (2901, 610527, 610500, '白水县', NULL);
INSERT INTO `yh_regions` VALUES (2902, 610528, 610500, '富平县', NULL);
INSERT INTO `yh_regions` VALUES (2903, 610581, 610500, '韩城市', NULL);
INSERT INTO `yh_regions` VALUES (2904, 610582, 610500, '华阴市', NULL);
INSERT INTO `yh_regions` VALUES (2905, 610602, 610600, '宝塔区', NULL);
INSERT INTO `yh_regions` VALUES (2906, 610603, 610600, '安塞区', NULL);
INSERT INTO `yh_regions` VALUES (2907, 610621, 610600, '延长县', NULL);
INSERT INTO `yh_regions` VALUES (2908, 610622, 610600, '延川县', NULL);
INSERT INTO `yh_regions` VALUES (2909, 610623, 610600, '子长县', NULL);
INSERT INTO `yh_regions` VALUES (2910, 610625, 610600, '志丹县', NULL);
INSERT INTO `yh_regions` VALUES (2911, 610626, 610600, '吴起县', NULL);
INSERT INTO `yh_regions` VALUES (2912, 610627, 610600, '甘泉县', NULL);
INSERT INTO `yh_regions` VALUES (2913, 610628, 610600, '富县', NULL);
INSERT INTO `yh_regions` VALUES (2914, 610629, 610600, '洛川县', NULL);
INSERT INTO `yh_regions` VALUES (2915, 610630, 610600, '宜川县', NULL);
INSERT INTO `yh_regions` VALUES (2916, 610631, 610600, '黄龙县', NULL);
INSERT INTO `yh_regions` VALUES (2917, 610632, 610600, '黄陵县', NULL);
INSERT INTO `yh_regions` VALUES (2918, 610702, 610700, '汉台区', NULL);
INSERT INTO `yh_regions` VALUES (2919, 610703, 610700, '南郑区', NULL);
INSERT INTO `yh_regions` VALUES (2920, 610722, 610700, '城固县', NULL);
INSERT INTO `yh_regions` VALUES (2921, 610723, 610700, '洋县', NULL);
INSERT INTO `yh_regions` VALUES (2922, 610724, 610700, '西乡县', NULL);
INSERT INTO `yh_regions` VALUES (2923, 610725, 610700, '勉县', NULL);
INSERT INTO `yh_regions` VALUES (2924, 610726, 610700, '宁强县', NULL);
INSERT INTO `yh_regions` VALUES (2925, 610727, 610700, '略阳县', NULL);
INSERT INTO `yh_regions` VALUES (2926, 610728, 610700, '镇巴县', NULL);
INSERT INTO `yh_regions` VALUES (2927, 610729, 610700, '留坝县', NULL);
INSERT INTO `yh_regions` VALUES (2928, 610730, 610700, '佛坪县', NULL);
INSERT INTO `yh_regions` VALUES (2929, 610802, 610800, '榆阳区', NULL);
INSERT INTO `yh_regions` VALUES (2930, 610803, 610800, '横山区', NULL);
INSERT INTO `yh_regions` VALUES (2931, 610822, 610800, '府谷县', NULL);
INSERT INTO `yh_regions` VALUES (2932, 610824, 610800, '靖边县', NULL);
INSERT INTO `yh_regions` VALUES (2933, 610825, 610800, '定边县', NULL);
INSERT INTO `yh_regions` VALUES (2934, 610826, 610800, '绥德县', NULL);
INSERT INTO `yh_regions` VALUES (2935, 610827, 610800, '米脂县', NULL);
INSERT INTO `yh_regions` VALUES (2936, 610828, 610800, '佳县', NULL);
INSERT INTO `yh_regions` VALUES (2937, 610829, 610800, '吴堡县', NULL);
INSERT INTO `yh_regions` VALUES (2938, 610830, 610800, '清涧县', NULL);
INSERT INTO `yh_regions` VALUES (2939, 610831, 610800, '子洲县', NULL);
INSERT INTO `yh_regions` VALUES (2940, 610881, 610800, '神木市', NULL);
INSERT INTO `yh_regions` VALUES (2941, 610902, 610900, '汉滨区', NULL);
INSERT INTO `yh_regions` VALUES (2942, 610921, 610900, '汉阴县', NULL);
INSERT INTO `yh_regions` VALUES (2943, 610922, 610900, '石泉县', NULL);
INSERT INTO `yh_regions` VALUES (2944, 610923, 610900, '宁陕县', NULL);
INSERT INTO `yh_regions` VALUES (2945, 610924, 610900, '紫阳县', NULL);
INSERT INTO `yh_regions` VALUES (2946, 610925, 610900, '岚皋县', NULL);
INSERT INTO `yh_regions` VALUES (2947, 610926, 610900, '平利县', NULL);
INSERT INTO `yh_regions` VALUES (2948, 610927, 610900, '镇坪县', NULL);
INSERT INTO `yh_regions` VALUES (2949, 610928, 610900, '旬阳县', NULL);
INSERT INTO `yh_regions` VALUES (2950, 610929, 610900, '白河县', NULL);
INSERT INTO `yh_regions` VALUES (2951, 611002, 611000, '商州区', NULL);
INSERT INTO `yh_regions` VALUES (2952, 611021, 611000, '洛南县', NULL);
INSERT INTO `yh_regions` VALUES (2953, 611022, 611000, '丹凤县', NULL);
INSERT INTO `yh_regions` VALUES (2954, 611023, 611000, '商南县', NULL);
INSERT INTO `yh_regions` VALUES (2955, 611024, 611000, '山阳县', NULL);
INSERT INTO `yh_regions` VALUES (2956, 611025, 611000, '镇安县', NULL);
INSERT INTO `yh_regions` VALUES (2957, 611026, 611000, '柞水县', NULL);
INSERT INTO `yh_regions` VALUES (2958, 620100, 620000, '兰州市', NULL);
INSERT INTO `yh_regions` VALUES (2959, 620200, 620000, '嘉峪关市', NULL);
INSERT INTO `yh_regions` VALUES (2960, 620300, 620000, '金昌市', NULL);
INSERT INTO `yh_regions` VALUES (2961, 620400, 620000, '白银市', NULL);
INSERT INTO `yh_regions` VALUES (2962, 620500, 620000, '天水市', NULL);
INSERT INTO `yh_regions` VALUES (2963, 620600, 620000, '武威市', NULL);
INSERT INTO `yh_regions` VALUES (2964, 620700, 620000, '张掖市', NULL);
INSERT INTO `yh_regions` VALUES (2965, 620800, 620000, '平凉市', NULL);
INSERT INTO `yh_regions` VALUES (2966, 620900, 620000, '酒泉市', NULL);
INSERT INTO `yh_regions` VALUES (2967, 621000, 620000, '庆阳市', NULL);
INSERT INTO `yh_regions` VALUES (2968, 621100, 620000, '定西市', NULL);
INSERT INTO `yh_regions` VALUES (2969, 621200, 620000, '陇南市', NULL);
INSERT INTO `yh_regions` VALUES (2970, 622900, 620000, '临夏回族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2971, 623000, 620000, '甘南藏族自治州', NULL);
INSERT INTO `yh_regions` VALUES (2972, 620102, 620100, '城关区', NULL);
INSERT INTO `yh_regions` VALUES (2973, 620103, 620100, '七里河区', NULL);
INSERT INTO `yh_regions` VALUES (2974, 620104, 620100, '西固区', NULL);
INSERT INTO `yh_regions` VALUES (2975, 620105, 620100, '安宁区', NULL);
INSERT INTO `yh_regions` VALUES (2976, 620111, 620100, '红古区', NULL);
INSERT INTO `yh_regions` VALUES (2977, 620121, 620100, '永登县', NULL);
INSERT INTO `yh_regions` VALUES (2978, 620122, 620100, '皋兰县', NULL);
INSERT INTO `yh_regions` VALUES (2979, 620123, 620100, '榆中县', NULL);
INSERT INTO `yh_regions` VALUES (2980, 620200, 620200, '嘉峪关市', NULL);
INSERT INTO `yh_regions` VALUES (2981, 620302, 620300, '金川区', NULL);
INSERT INTO `yh_regions` VALUES (2982, 620321, 620300, '永昌县', NULL);
INSERT INTO `yh_regions` VALUES (2983, 620402, 620400, '白银区', NULL);
INSERT INTO `yh_regions` VALUES (2984, 620403, 620400, '平川区', NULL);
INSERT INTO `yh_regions` VALUES (2985, 620421, 620400, '靖远县', NULL);
INSERT INTO `yh_regions` VALUES (2986, 620422, 620400, '会宁县', NULL);
INSERT INTO `yh_regions` VALUES (2987, 620423, 620400, '景泰县', NULL);
INSERT INTO `yh_regions` VALUES (2988, 620502, 620500, '秦州区', NULL);
INSERT INTO `yh_regions` VALUES (2989, 620503, 620500, '麦积区', NULL);
INSERT INTO `yh_regions` VALUES (2990, 620521, 620500, '清水县', NULL);
INSERT INTO `yh_regions` VALUES (2991, 620522, 620500, '秦安县', NULL);
INSERT INTO `yh_regions` VALUES (2992, 620523, 620500, '甘谷县', NULL);
INSERT INTO `yh_regions` VALUES (2993, 620524, 620500, '武山县', NULL);
INSERT INTO `yh_regions` VALUES (2994, 620525, 620500, '张家川回族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2995, 620602, 620600, '凉州区', NULL);
INSERT INTO `yh_regions` VALUES (2996, 620621, 620600, '民勤县', NULL);
INSERT INTO `yh_regions` VALUES (2997, 620622, 620600, '古浪县', NULL);
INSERT INTO `yh_regions` VALUES (2998, 620623, 620600, '天祝藏族自治县', NULL);
INSERT INTO `yh_regions` VALUES (2999, 620702, 620700, '甘州区', NULL);
INSERT INTO `yh_regions` VALUES (3000, 620721, 620700, '肃南裕固族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3001, 620722, 620700, '民乐县', NULL);
INSERT INTO `yh_regions` VALUES (3002, 620723, 620700, '临泽县', NULL);
INSERT INTO `yh_regions` VALUES (3003, 620724, 620700, '高台县', NULL);
INSERT INTO `yh_regions` VALUES (3004, 620725, 620700, '山丹县', NULL);
INSERT INTO `yh_regions` VALUES (3005, 620802, 620800, '崆峒区', NULL);
INSERT INTO `yh_regions` VALUES (3006, 620821, 620800, '泾川县', NULL);
INSERT INTO `yh_regions` VALUES (3007, 620822, 620800, '灵台县', NULL);
INSERT INTO `yh_regions` VALUES (3008, 620823, 620800, '崇信县', NULL);
INSERT INTO `yh_regions` VALUES (3009, 620824, 620800, '华亭县', NULL);
INSERT INTO `yh_regions` VALUES (3010, 620825, 620800, '庄浪县', NULL);
INSERT INTO `yh_regions` VALUES (3011, 620826, 620800, '静宁县', NULL);
INSERT INTO `yh_regions` VALUES (3012, 620902, 620900, '肃州区', NULL);
INSERT INTO `yh_regions` VALUES (3013, 620921, 620900, '金塔县', NULL);
INSERT INTO `yh_regions` VALUES (3014, 620922, 620900, '瓜州县', NULL);
INSERT INTO `yh_regions` VALUES (3015, 620923, 620900, '肃北蒙古族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3016, 620924, 620900, '阿克塞哈萨克族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3017, 620981, 620900, '玉门市', NULL);
INSERT INTO `yh_regions` VALUES (3018, 620982, 620900, '敦煌市', NULL);
INSERT INTO `yh_regions` VALUES (3019, 621002, 621000, '西峰区', NULL);
INSERT INTO `yh_regions` VALUES (3020, 621021, 621000, '庆城县', NULL);
INSERT INTO `yh_regions` VALUES (3021, 621022, 621000, '环县', NULL);
INSERT INTO `yh_regions` VALUES (3022, 621023, 621000, '华池县', NULL);
INSERT INTO `yh_regions` VALUES (3023, 621024, 621000, '合水县', NULL);
INSERT INTO `yh_regions` VALUES (3024, 621025, 621000, '正宁县', NULL);
INSERT INTO `yh_regions` VALUES (3025, 621026, 621000, '宁县', NULL);
INSERT INTO `yh_regions` VALUES (3026, 621027, 621000, '镇原县', NULL);
INSERT INTO `yh_regions` VALUES (3027, 621102, 621100, '安定区', NULL);
INSERT INTO `yh_regions` VALUES (3028, 621121, 621100, '通渭县', NULL);
INSERT INTO `yh_regions` VALUES (3029, 621122, 621100, '陇西县', NULL);
INSERT INTO `yh_regions` VALUES (3030, 621123, 621100, '渭源县', NULL);
INSERT INTO `yh_regions` VALUES (3031, 621124, 621100, '临洮县', NULL);
INSERT INTO `yh_regions` VALUES (3032, 621125, 621100, '漳县', NULL);
INSERT INTO `yh_regions` VALUES (3033, 621126, 621100, '岷县', NULL);
INSERT INTO `yh_regions` VALUES (3034, 621202, 621200, '武都区', NULL);
INSERT INTO `yh_regions` VALUES (3035, 621221, 621200, '成县', NULL);
INSERT INTO `yh_regions` VALUES (3036, 621222, 621200, '文县', NULL);
INSERT INTO `yh_regions` VALUES (3037, 621223, 621200, '宕昌县', NULL);
INSERT INTO `yh_regions` VALUES (3038, 621224, 621200, '康县', NULL);
INSERT INTO `yh_regions` VALUES (3039, 621225, 621200, '西和县', NULL);
INSERT INTO `yh_regions` VALUES (3040, 621226, 621200, '礼县', NULL);
INSERT INTO `yh_regions` VALUES (3041, 621227, 621200, '徽县', NULL);
INSERT INTO `yh_regions` VALUES (3042, 621228, 621200, '两当县', NULL);
INSERT INTO `yh_regions` VALUES (3043, 622901, 622900, '临夏市', NULL);
INSERT INTO `yh_regions` VALUES (3044, 622921, 622900, '临夏县', NULL);
INSERT INTO `yh_regions` VALUES (3045, 622922, 622900, '康乐县', NULL);
INSERT INTO `yh_regions` VALUES (3046, 622923, 622900, '永靖县', NULL);
INSERT INTO `yh_regions` VALUES (3047, 622924, 622900, '广河县', NULL);
INSERT INTO `yh_regions` VALUES (3048, 622925, 622900, '和政县', NULL);
INSERT INTO `yh_regions` VALUES (3049, 622926, 622900, '东乡族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3050, 622927, 622900, '积石山保安族东乡族撒拉族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3051, 623001, 623000, '合作市', NULL);
INSERT INTO `yh_regions` VALUES (3052, 623021, 623000, '临潭县', NULL);
INSERT INTO `yh_regions` VALUES (3053, 623022, 623000, '卓尼县', NULL);
INSERT INTO `yh_regions` VALUES (3054, 623023, 623000, '舟曲县', NULL);
INSERT INTO `yh_regions` VALUES (3055, 623024, 623000, '迭部县', NULL);
INSERT INTO `yh_regions` VALUES (3056, 623025, 623000, '玛曲县', NULL);
INSERT INTO `yh_regions` VALUES (3057, 623026, 623000, '碌曲县', NULL);
INSERT INTO `yh_regions` VALUES (3058, 623027, 623000, '夏河县', NULL);
INSERT INTO `yh_regions` VALUES (3059, 630100, 630000, '西宁市', NULL);
INSERT INTO `yh_regions` VALUES (3060, 630200, 630000, '海东市', NULL);
INSERT INTO `yh_regions` VALUES (3061, 632200, 630000, '海北藏族自治州', NULL);
INSERT INTO `yh_regions` VALUES (3062, 632300, 630000, '黄南藏族自治州', NULL);
INSERT INTO `yh_regions` VALUES (3063, 632500, 630000, '海南藏族自治州', NULL);
INSERT INTO `yh_regions` VALUES (3064, 632600, 630000, '果洛藏族自治州', NULL);
INSERT INTO `yh_regions` VALUES (3065, 632700, 630000, '玉树藏族自治州', NULL);
INSERT INTO `yh_regions` VALUES (3066, 632800, 630000, '海西蒙古族藏族自治州', NULL);
INSERT INTO `yh_regions` VALUES (3067, 630102, 630100, '城东区', NULL);
INSERT INTO `yh_regions` VALUES (3068, 630103, 630100, '城中区', NULL);
INSERT INTO `yh_regions` VALUES (3069, 630104, 630100, '城西区', NULL);
INSERT INTO `yh_regions` VALUES (3070, 630105, 630100, '城北区', NULL);
INSERT INTO `yh_regions` VALUES (3071, 630121, 630100, '大通回族土族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3072, 630122, 630100, '湟中县', NULL);
INSERT INTO `yh_regions` VALUES (3073, 630123, 630100, '湟源县', NULL);
INSERT INTO `yh_regions` VALUES (3074, 630202, 630200, '乐都区', NULL);
INSERT INTO `yh_regions` VALUES (3075, 630203, 630200, '平安区', NULL);
INSERT INTO `yh_regions` VALUES (3076, 630222, 630200, '民和回族土族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3077, 630223, 630200, '互助土族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3078, 630224, 630200, '化隆回族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3079, 630225, 630200, '循化撒拉族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3080, 632221, 632200, '门源回族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3081, 632222, 632200, '祁连县', NULL);
INSERT INTO `yh_regions` VALUES (3082, 632223, 632200, '海晏县', NULL);
INSERT INTO `yh_regions` VALUES (3083, 632224, 632200, '刚察县', NULL);
INSERT INTO `yh_regions` VALUES (3084, 632321, 632300, '同仁县', NULL);
INSERT INTO `yh_regions` VALUES (3085, 632322, 632300, '尖扎县', NULL);
INSERT INTO `yh_regions` VALUES (3086, 632323, 632300, '泽库县', NULL);
INSERT INTO `yh_regions` VALUES (3087, 632324, 632300, '河南蒙古族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3088, 632521, 632500, '共和县', NULL);
INSERT INTO `yh_regions` VALUES (3089, 632522, 632500, '同德县', NULL);
INSERT INTO `yh_regions` VALUES (3090, 632523, 632500, '贵德县', NULL);
INSERT INTO `yh_regions` VALUES (3091, 632524, 632500, '兴海县', NULL);
INSERT INTO `yh_regions` VALUES (3092, 632525, 632500, '贵南县', NULL);
INSERT INTO `yh_regions` VALUES (3093, 632621, 632600, '玛沁县', NULL);
INSERT INTO `yh_regions` VALUES (3094, 632622, 632600, '班玛县', NULL);
INSERT INTO `yh_regions` VALUES (3095, 632623, 632600, '甘德县', NULL);
INSERT INTO `yh_regions` VALUES (3096, 632624, 632600, '达日县', NULL);
INSERT INTO `yh_regions` VALUES (3097, 632625, 632600, '久治县', NULL);
INSERT INTO `yh_regions` VALUES (3098, 632626, 632600, '玛多县', NULL);
INSERT INTO `yh_regions` VALUES (3099, 632701, 632700, '玉树市', NULL);
INSERT INTO `yh_regions` VALUES (3100, 632722, 632700, '杂多县', NULL);
INSERT INTO `yh_regions` VALUES (3101, 632723, 632700, '称多县', NULL);
INSERT INTO `yh_regions` VALUES (3102, 632724, 632700, '治多县', NULL);
INSERT INTO `yh_regions` VALUES (3103, 632725, 632700, '囊谦县', NULL);
INSERT INTO `yh_regions` VALUES (3104, 632726, 632700, '曲麻莱县', NULL);
INSERT INTO `yh_regions` VALUES (3105, 632801, 632800, '格尔木市', NULL);
INSERT INTO `yh_regions` VALUES (3106, 632802, 632800, '德令哈市', NULL);
INSERT INTO `yh_regions` VALUES (3107, 632821, 632800, '乌兰县', NULL);
INSERT INTO `yh_regions` VALUES (3108, 632822, 632800, '都兰县', NULL);
INSERT INTO `yh_regions` VALUES (3109, 632823, 632800, '天峻县', NULL);
INSERT INTO `yh_regions` VALUES (3110, 632825, 632800, '海西蒙古族藏族自治州直辖', NULL);
INSERT INTO `yh_regions` VALUES (3111, 640100, 640000, '银川市', NULL);
INSERT INTO `yh_regions` VALUES (3112, 640200, 640000, '石嘴山市', NULL);
INSERT INTO `yh_regions` VALUES (3113, 640300, 640000, '吴忠市', NULL);
INSERT INTO `yh_regions` VALUES (3114, 640400, 640000, '固原市', NULL);
INSERT INTO `yh_regions` VALUES (3115, 640500, 640000, '中卫市', NULL);
INSERT INTO `yh_regions` VALUES (3116, 640104, 640100, '兴庆区', NULL);
INSERT INTO `yh_regions` VALUES (3117, 640105, 640100, '西夏区', NULL);
INSERT INTO `yh_regions` VALUES (3118, 640106, 640100, '金凤区', NULL);
INSERT INTO `yh_regions` VALUES (3119, 640121, 640100, '永宁县', NULL);
INSERT INTO `yh_regions` VALUES (3120, 640122, 640100, '贺兰县', NULL);
INSERT INTO `yh_regions` VALUES (3121, 640181, 640100, '灵武市', NULL);
INSERT INTO `yh_regions` VALUES (3122, 640202, 640200, '大武口区', NULL);
INSERT INTO `yh_regions` VALUES (3123, 640205, 640200, '惠农区', NULL);
INSERT INTO `yh_regions` VALUES (3124, 640221, 640200, '平罗县', NULL);
INSERT INTO `yh_regions` VALUES (3125, 640302, 640300, '利通区', NULL);
INSERT INTO `yh_regions` VALUES (3126, 640303, 640300, '红寺堡区', NULL);
INSERT INTO `yh_regions` VALUES (3127, 640323, 640300, '盐池县', NULL);
INSERT INTO `yh_regions` VALUES (3128, 640324, 640300, '同心县', NULL);
INSERT INTO `yh_regions` VALUES (3129, 640381, 640300, '青铜峡市', NULL);
INSERT INTO `yh_regions` VALUES (3130, 640402, 640400, '原州区', NULL);
INSERT INTO `yh_regions` VALUES (3131, 640422, 640400, '西吉县', NULL);
INSERT INTO `yh_regions` VALUES (3132, 640423, 640400, '隆德县', NULL);
INSERT INTO `yh_regions` VALUES (3133, 640424, 640400, '泾源县', NULL);
INSERT INTO `yh_regions` VALUES (3134, 640425, 640400, '彭阳县', NULL);
INSERT INTO `yh_regions` VALUES (3135, 640502, 640500, '沙坡头区', NULL);
INSERT INTO `yh_regions` VALUES (3136, 640521, 640500, '中宁县', NULL);
INSERT INTO `yh_regions` VALUES (3137, 640522, 640500, '海原县', NULL);
INSERT INTO `yh_regions` VALUES (3138, 650100, 650000, '乌鲁木齐市', NULL);
INSERT INTO `yh_regions` VALUES (3139, 650200, 650000, '克拉玛依市', NULL);
INSERT INTO `yh_regions` VALUES (3140, 650400, 650000, '吐鲁番市', NULL);
INSERT INTO `yh_regions` VALUES (3141, 650500, 650000, '哈密市', NULL);
INSERT INTO `yh_regions` VALUES (3142, 652300, 650000, '昌吉回族自治州', NULL);
INSERT INTO `yh_regions` VALUES (3143, 652700, 650000, '博尔塔拉蒙古自治州', NULL);
INSERT INTO `yh_regions` VALUES (3144, 652800, 650000, '巴音郭楞蒙古自治州', NULL);
INSERT INTO `yh_regions` VALUES (3145, 652900, 650000, '阿克苏地区', NULL);
INSERT INTO `yh_regions` VALUES (3146, 653000, 650000, '克孜勒苏柯尔克孜自治州', NULL);
INSERT INTO `yh_regions` VALUES (3147, 653100, 650000, '喀什地区', NULL);
INSERT INTO `yh_regions` VALUES (3148, 653200, 650000, '和田地区', NULL);
INSERT INTO `yh_regions` VALUES (3149, 654000, 650000, '伊犁哈萨克自治州', NULL);
INSERT INTO `yh_regions` VALUES (3150, 654200, 650000, '塔城地区', NULL);
INSERT INTO `yh_regions` VALUES (3151, 654300, 650000, '阿勒泰地区', NULL);
INSERT INTO `yh_regions` VALUES (3152, 659001, 650000, '石河子市', NULL);
INSERT INTO `yh_regions` VALUES (3153, 659002, 650000, '阿拉尔市', NULL);
INSERT INTO `yh_regions` VALUES (3154, 659003, 650000, '图木舒克市', NULL);
INSERT INTO `yh_regions` VALUES (3155, 659004, 650000, '五家渠市', NULL);
INSERT INTO `yh_regions` VALUES (3156, 659005, 650000, '北屯市', NULL);
INSERT INTO `yh_regions` VALUES (3157, 659006, 650000, '铁门关市', NULL);
INSERT INTO `yh_regions` VALUES (3158, 659007, 650000, '双河市', NULL);
INSERT INTO `yh_regions` VALUES (3159, 659008, 650000, '可克达拉市', NULL);
INSERT INTO `yh_regions` VALUES (3160, 659009, 650000, '昆玉市', NULL);
INSERT INTO `yh_regions` VALUES (3161, 650102, 650100, '天山区', NULL);
INSERT INTO `yh_regions` VALUES (3162, 650103, 650100, '沙依巴克区', NULL);
INSERT INTO `yh_regions` VALUES (3163, 650104, 650100, '新市区', NULL);
INSERT INTO `yh_regions` VALUES (3164, 650105, 650100, '水磨沟区', NULL);
INSERT INTO `yh_regions` VALUES (3165, 650106, 650100, '头屯河区', NULL);
INSERT INTO `yh_regions` VALUES (3166, 650107, 650100, '达坂城区', NULL);
INSERT INTO `yh_regions` VALUES (3167, 650109, 650100, '米东区', NULL);
INSERT INTO `yh_regions` VALUES (3168, 650121, 650100, '乌鲁木齐县', NULL);
INSERT INTO `yh_regions` VALUES (3169, 650202, 650200, '独山子区', NULL);
INSERT INTO `yh_regions` VALUES (3170, 650203, 650200, '克拉玛依区', NULL);
INSERT INTO `yh_regions` VALUES (3171, 650204, 650200, '白碱滩区', NULL);
INSERT INTO `yh_regions` VALUES (3172, 650205, 650200, '乌尔禾区', NULL);
INSERT INTO `yh_regions` VALUES (3173, 650402, 650400, '高昌区', NULL);
INSERT INTO `yh_regions` VALUES (3174, 650421, 650400, '鄯善县', NULL);
INSERT INTO `yh_regions` VALUES (3175, 650422, 650400, '托克逊县', NULL);
INSERT INTO `yh_regions` VALUES (3176, 650502, 650500, '伊州区', NULL);
INSERT INTO `yh_regions` VALUES (3177, 650521, 650500, '巴里坤哈萨克自治县', NULL);
INSERT INTO `yh_regions` VALUES (3178, 650522, 650500, '伊吾县', NULL);
INSERT INTO `yh_regions` VALUES (3179, 652301, 652300, '昌吉市', NULL);
INSERT INTO `yh_regions` VALUES (3180, 652302, 652300, '阜康市', NULL);
INSERT INTO `yh_regions` VALUES (3181, 652323, 652300, '呼图壁县', NULL);
INSERT INTO `yh_regions` VALUES (3182, 652324, 652300, '玛纳斯县', NULL);
INSERT INTO `yh_regions` VALUES (3183, 652325, 652300, '奇台县', NULL);
INSERT INTO `yh_regions` VALUES (3184, 652327, 652300, '吉木萨尔县', NULL);
INSERT INTO `yh_regions` VALUES (3185, 652328, 652300, '木垒哈萨克自治县', NULL);
INSERT INTO `yh_regions` VALUES (3186, 652701, 652700, '博乐市', NULL);
INSERT INTO `yh_regions` VALUES (3187, 652702, 652700, '阿拉山口市', NULL);
INSERT INTO `yh_regions` VALUES (3188, 652722, 652700, '精河县', NULL);
INSERT INTO `yh_regions` VALUES (3189, 652723, 652700, '温泉县', NULL);
INSERT INTO `yh_regions` VALUES (3190, 652801, 652800, '库尔勒市', NULL);
INSERT INTO `yh_regions` VALUES (3191, 652822, 652800, '轮台县', NULL);
INSERT INTO `yh_regions` VALUES (3192, 652823, 652800, '尉犁县', NULL);
INSERT INTO `yh_regions` VALUES (3193, 652824, 652800, '若羌县', NULL);
INSERT INTO `yh_regions` VALUES (3194, 652825, 652800, '且末县', NULL);
INSERT INTO `yh_regions` VALUES (3195, 652826, 652800, '焉耆回族自治县', NULL);
INSERT INTO `yh_regions` VALUES (3196, 652827, 652800, '和静县', NULL);
INSERT INTO `yh_regions` VALUES (3197, 652828, 652800, '和硕县', NULL);
INSERT INTO `yh_regions` VALUES (3198, 652829, 652800, '博湖县', NULL);
INSERT INTO `yh_regions` VALUES (3199, 652901, 652900, '阿克苏市', NULL);
INSERT INTO `yh_regions` VALUES (3200, 652922, 652900, '温宿县', NULL);
INSERT INTO `yh_regions` VALUES (3201, 652923, 652900, '库车县', NULL);
INSERT INTO `yh_regions` VALUES (3202, 652924, 652900, '沙雅县', NULL);
INSERT INTO `yh_regions` VALUES (3203, 652925, 652900, '新和县', NULL);
INSERT INTO `yh_regions` VALUES (3204, 652926, 652900, '拜城县', NULL);
INSERT INTO `yh_regions` VALUES (3205, 652927, 652900, '乌什县', NULL);
INSERT INTO `yh_regions` VALUES (3206, 652928, 652900, '阿瓦提县', NULL);
INSERT INTO `yh_regions` VALUES (3207, 652929, 652900, '柯坪县', NULL);
INSERT INTO `yh_regions` VALUES (3208, 653001, 653000, '阿图什市', NULL);
INSERT INTO `yh_regions` VALUES (3209, 653022, 653000, '阿克陶县', NULL);
INSERT INTO `yh_regions` VALUES (3210, 653023, 653000, '阿合奇县', NULL);
INSERT INTO `yh_regions` VALUES (3211, 653024, 653000, '乌恰县', NULL);
INSERT INTO `yh_regions` VALUES (3212, 653101, 653100, '喀什市', NULL);
INSERT INTO `yh_regions` VALUES (3213, 653121, 653100, '疏附县', NULL);
INSERT INTO `yh_regions` VALUES (3214, 653122, 653100, '疏勒县', NULL);
INSERT INTO `yh_regions` VALUES (3215, 653123, 653100, '英吉沙县', NULL);
INSERT INTO `yh_regions` VALUES (3216, 653124, 653100, '泽普县', NULL);
INSERT INTO `yh_regions` VALUES (3217, 653125, 653100, '莎车县', NULL);
INSERT INTO `yh_regions` VALUES (3218, 653126, 653100, '叶城县', NULL);
INSERT INTO `yh_regions` VALUES (3219, 653127, 653100, '麦盖提县', NULL);
INSERT INTO `yh_regions` VALUES (3220, 653128, 653100, '岳普湖县', NULL);
INSERT INTO `yh_regions` VALUES (3221, 653129, 653100, '伽师县', NULL);
INSERT INTO `yh_regions` VALUES (3222, 653130, 653100, '巴楚县', NULL);
INSERT INTO `yh_regions` VALUES (3223, 653131, 653100, '塔什库尔干塔吉克自治县', NULL);
INSERT INTO `yh_regions` VALUES (3224, 653201, 653200, '和田市', NULL);
INSERT INTO `yh_regions` VALUES (3225, 653221, 653200, '和田县', NULL);
INSERT INTO `yh_regions` VALUES (3226, 653222, 653200, '墨玉县', NULL);
INSERT INTO `yh_regions` VALUES (3227, 653223, 653200, '皮山县', NULL);
INSERT INTO `yh_regions` VALUES (3228, 653224, 653200, '洛浦县', NULL);
INSERT INTO `yh_regions` VALUES (3229, 653225, 653200, '策勒县', NULL);
INSERT INTO `yh_regions` VALUES (3230, 653226, 653200, '于田县', NULL);
INSERT INTO `yh_regions` VALUES (3231, 653227, 653200, '民丰县', NULL);
INSERT INTO `yh_regions` VALUES (3232, 654002, 654000, '伊宁市', NULL);
INSERT INTO `yh_regions` VALUES (3233, 654003, 654000, '奎屯市', NULL);
INSERT INTO `yh_regions` VALUES (3234, 654004, 654000, '霍尔果斯市', NULL);
INSERT INTO `yh_regions` VALUES (3235, 654021, 654000, '伊宁县', NULL);
INSERT INTO `yh_regions` VALUES (3236, 654022, 654000, '察布查尔锡伯自治县', NULL);
INSERT INTO `yh_regions` VALUES (3237, 654023, 654000, '霍城县', NULL);
INSERT INTO `yh_regions` VALUES (3238, 654024, 654000, '巩留县', NULL);
INSERT INTO `yh_regions` VALUES (3239, 654025, 654000, '新源县', NULL);
INSERT INTO `yh_regions` VALUES (3240, 654026, 654000, '昭苏县', NULL);
INSERT INTO `yh_regions` VALUES (3241, 654027, 654000, '特克斯县', NULL);
INSERT INTO `yh_regions` VALUES (3242, 654028, 654000, '尼勒克县', NULL);
INSERT INTO `yh_regions` VALUES (3243, 654201, 654200, '塔城市', NULL);
INSERT INTO `yh_regions` VALUES (3244, 654202, 654200, '乌苏市', NULL);
INSERT INTO `yh_regions` VALUES (3245, 654221, 654200, '额敏县', NULL);
INSERT INTO `yh_regions` VALUES (3246, 654223, 654200, '沙湾县', NULL);
INSERT INTO `yh_regions` VALUES (3247, 654224, 654200, '托里县', NULL);
INSERT INTO `yh_regions` VALUES (3248, 654225, 654200, '裕民县', NULL);
INSERT INTO `yh_regions` VALUES (3249, 654226, 654200, '和布克赛尔蒙古自治县', NULL);
INSERT INTO `yh_regions` VALUES (3250, 654301, 654300, '阿勒泰市', NULL);
INSERT INTO `yh_regions` VALUES (3251, 654321, 654300, '布尔津县', NULL);
INSERT INTO `yh_regions` VALUES (3252, 654322, 654300, '富蕴县', NULL);
INSERT INTO `yh_regions` VALUES (3253, 654323, 654300, '福海县', NULL);
INSERT INTO `yh_regions` VALUES (3254, 654324, 654300, '哈巴河县', NULL);
INSERT INTO `yh_regions` VALUES (3255, 654325, 654300, '青河县', NULL);
INSERT INTO `yh_regions` VALUES (3256, 654326, 654300, '吉木乃县', NULL);
INSERT INTO `yh_regions` VALUES (3257, 659001, 659001, '石河子市', NULL);
INSERT INTO `yh_regions` VALUES (3258, 659002, 659002, '阿拉尔市', NULL);
INSERT INTO `yh_regions` VALUES (3259, 659003, 659003, '图木舒克市', NULL);
INSERT INTO `yh_regions` VALUES (3260, 659004, 659004, '五家渠市', NULL);
INSERT INTO `yh_regions` VALUES (3261, 659005, 659005, '北屯市', NULL);
INSERT INTO `yh_regions` VALUES (3262, 659006, 659006, '铁门关市', NULL);
INSERT INTO `yh_regions` VALUES (3263, 659007, 659007, '双河市', NULL);
INSERT INTO `yh_regions` VALUES (3264, 659008, 659008, '可克达拉市', NULL);
INSERT INTO `yh_regions` VALUES (3265, 659009, 659009, '昆玉市', NULL);
INSERT INTO `yh_regions` VALUES (3266, 810100, 810000, '香港城区', NULL);
INSERT INTO `yh_regions` VALUES (3267, 810101, 810100, '中西区', NULL);
INSERT INTO `yh_regions` VALUES (3268, 810102, 810100, '湾仔区', NULL);
INSERT INTO `yh_regions` VALUES (3269, 810103, 810100, '东区', NULL);
INSERT INTO `yh_regions` VALUES (3270, 810104, 810100, '南区', NULL);
INSERT INTO `yh_regions` VALUES (3271, 810105, 810100, '油尖旺区', NULL);
INSERT INTO `yh_regions` VALUES (3272, 810106, 810100, '深水埗区', NULL);
INSERT INTO `yh_regions` VALUES (3273, 810107, 810100, '九龙城区', NULL);
INSERT INTO `yh_regions` VALUES (3274, 810108, 810100, '黄大仙区', NULL);
INSERT INTO `yh_regions` VALUES (3275, 810109, 810100, '观塘区', NULL);
INSERT INTO `yh_regions` VALUES (3276, 810110, 810100, '荃湾区', NULL);
INSERT INTO `yh_regions` VALUES (3277, 810111, 810100, '屯门区', NULL);
INSERT INTO `yh_regions` VALUES (3278, 810112, 810100, '元朗区', NULL);
INSERT INTO `yh_regions` VALUES (3279, 810113, 810100, '北区', NULL);
INSERT INTO `yh_regions` VALUES (3280, 810114, 810100, '大埔区', NULL);
INSERT INTO `yh_regions` VALUES (3281, 810115, 810100, '西贡区', NULL);
INSERT INTO `yh_regions` VALUES (3282, 810116, 810100, '沙田区', NULL);
INSERT INTO `yh_regions` VALUES (3283, 810117, 810100, '葵青区', NULL);
INSERT INTO `yh_regions` VALUES (3284, 810118, 810100, '离岛区', NULL);
INSERT INTO `yh_regions` VALUES (3285, 820100, 820000, '澳门城区', NULL);
INSERT INTO `yh_regions` VALUES (3286, 820101, 820100, '花地玛堂区', NULL);
INSERT INTO `yh_regions` VALUES (3287, 820102, 820100, '花王堂区', NULL);
INSERT INTO `yh_regions` VALUES (3288, 820103, 820100, '望德堂区', NULL);
INSERT INTO `yh_regions` VALUES (3289, 820104, 820100, '大堂区', NULL);
INSERT INTO `yh_regions` VALUES (3290, 820105, 820100, '风顺堂区', NULL);
INSERT INTO `yh_regions` VALUES (3291, 820106, 820100, '嘉模堂区', NULL);
INSERT INTO `yh_regions` VALUES (3292, 820107, 820100, '路凼填海区', NULL);
INSERT INTO `yh_regions` VALUES (3293, 820108, 820100, '圣方济各堂区', NULL);
INSERT INTO `yh_regions` VALUES (3294, 710100, 710000, '台湾', NULL);
INSERT INTO `yh_regions` VALUES (3295, 710101, 710100, '金门县', NULL);
INSERT INTO `yh_regions` VALUES (3296, 710102, 710100, '连江县', NULL);
INSERT INTO `yh_regions` VALUES (3297, 710103, 710100, '苗栗县', NULL);
INSERT INTO `yh_regions` VALUES (3298, 710104, 710100, '南投县', NULL);
INSERT INTO `yh_regions` VALUES (3299, 710105, 710100, '澎湖县', NULL);
INSERT INTO `yh_regions` VALUES (3300, 710106, 710100, '屏东县', NULL);
INSERT INTO `yh_regions` VALUES (3301, 710107, 710100, '台东县', NULL);
INSERT INTO `yh_regions` VALUES (3302, 710108, 710100, '台中市', NULL);
INSERT INTO `yh_regions` VALUES (3303, 710109, 710100, '台南市', NULL);
INSERT INTO `yh_regions` VALUES (3304, 710110, 710100, '台北市', NULL);
INSERT INTO `yh_regions` VALUES (3305, 710111, 710100, '桃园市', NULL);
INSERT INTO `yh_regions` VALUES (3306, 710112, 710100, '云林县', NULL);
INSERT INTO `yh_regions` VALUES (3307, 710113, 710100, '新北市', NULL);
INSERT INTO `yh_regions` VALUES (3308, 710114, 710100, '新竹市', NULL);
INSERT INTO `yh_regions` VALUES (3309, 710115, 710100, '彰化县', NULL);
INSERT INTO `yh_regions` VALUES (3310, 710116, 710100, '嘉义县', NULL);
INSERT INTO `yh_regions` VALUES (3311, 710117, 710100, '新竹县', NULL);
INSERT INTO `yh_regions` VALUES (3312, 710118, 710100, '花莲县', NULL);
INSERT INTO `yh_regions` VALUES (3313, 710119, 710100, '宜兰县', NULL);
INSERT INTO `yh_regions` VALUES (3314, 710120, 710100, '高雄', NULL);
INSERT INTO `yh_regions` VALUES (3315, 710121, 710100, '基隆市', NULL);

-- ----------------------------
-- Table structure for yh_role_admin
-- ----------------------------
DROP TABLE IF EXISTS `yh_role_admin`;
CREATE TABLE `yh_role_admin`  (
  `user_id` int(10) NOT NULL,
  `role_id` int(11) NOT NULL,
  INDEX `role_admin_role_id_foreign`(`role_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_role_admin
-- ----------------------------
INSERT INTO `yh_role_admin` VALUES (1, 1);
INSERT INTO `yh_role_admin` VALUES (20, 1);
INSERT INTO `yh_role_admin` VALUES (20, 2);
INSERT INTO `yh_role_admin` VALUES (21, 2);
INSERT INTO `yh_role_admin` VALUES (21, 1);
INSERT INTO `yh_role_admin` VALUES (22, 1);
INSERT INTO `yh_role_admin` VALUES (22, 2);
INSERT INTO `yh_role_admin` VALUES (23, 2);
INSERT INTO `yh_role_admin` VALUES (23, 28);
INSERT INTO `yh_role_admin` VALUES (24, 1);
INSERT INTO `yh_role_admin` VALUES (24, 2);
INSERT INTO `yh_role_admin` VALUES (25, 1);
INSERT INTO `yh_role_admin` VALUES (25, 2);
INSERT INTO `yh_role_admin` VALUES (26, 1);
INSERT INTO `yh_role_admin` VALUES (26, 2);
INSERT INTO `yh_role_admin` VALUES (27, 1);
INSERT INTO `yh_role_admin` VALUES (27, 2);
INSERT INTO `yh_role_admin` VALUES (28, 1);
INSERT INTO `yh_role_admin` VALUES (28, 2);
INSERT INTO `yh_role_admin` VALUES (2, 2);
INSERT INTO `yh_role_admin` VALUES (2, 1);
INSERT INTO `yh_role_admin` VALUES (2, 28);

-- ----------------------------
-- Table structure for yh_roles
-- ----------------------------
DROP TABLE IF EXISTS `yh_roles`;
CREATE TABLE `yh_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_roles
-- ----------------------------
INSERT INTO `yh_roles` VALUES (1, 'SuperAdmin555', '超级管理员', '拥有所有的权限', '2017-09-28 23:45:46', '2019-07-19 23:32:45');
INSERT INTO `yh_roles` VALUES (2, 'SuperAdmin3555', '超级管理2', '拥222所有的权限', '2017-09-28 23:45:46', '2019-07-19 23:32:36');
INSERT INTO `yh_roles` VALUES (28, 'SuperAdmin311', 'SuperAdmin3', 'SuperAdmin3', '2019-07-18 23:55:45', '2019-07-18 23:55:45');

-- ----------------------------
-- Table structure for yh_scene_course
-- ----------------------------
DROP TABLE IF EXISTS `yh_scene_course`;
CREATE TABLE `yh_scene_course`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `class_id` smallint(5) NOT NULL COMMENT '分类ID',
  `course_id` int(11) NULL DEFAULT NULL COMMENT '课程id',
  `subjec_id` int(11) NULL DEFAULT NULL COMMENT '科目id',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '课程标题-班级',
  `start_time` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0) COMMENT '开始时间',
  `end_time` timestamp(0) NOT NULL COMMENT '结束时间',
  `checkout_time` timestamp(0) NULL DEFAULT NULL COMMENT '二维码生成时间',
  `period_num` int(11) NOT NULL COMMENT '总课时数',
  `introduce` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '课程说明',
  `sort` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序，数值越大越靠前',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 101 COMMENT '状态：100=关闭，101=开启',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '现场课程表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_shop_orders
-- ----------------------------
DROP TABLE IF EXISTS `yh_shop_orders`;
CREATE TABLE `yh_shop_orders`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `address_id` int(10) NULL DEFAULT NULL COMMENT '收货地址id',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '姓名',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '电话',
  `order_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '订单编号',
  `order_amount` decimal(10, 2) NOT NULL COMMENT '订单金额',
  `pay_coupons_numbe` decimal(10, 2) NULL DEFAULT NULL COMMENT '支付优惠券额度',
  `pay_money` decimal(10, 2) NOT NULL COMMENT '支付金额',
  `pay_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '支付状态：100=未付款,101=待发货,102=待收货,103=待评价,104=已完成，105=已取消',
  `shipping_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '发货状态：100=待发货,101=已发货',
  `admin_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '操作管理员ID',
  `aw_order` int(11) NULL DEFAULT NULL COMMENT '微信，支付宝订单号',
  `pay_type` smallint(3) NULL DEFAULT NULL COMMENT '支付类型：100=微信支付,101=支付宝',
  `shipping_methods` smallint(3) NULL DEFAULT NULL COMMENT '配送方式：100=送货上门,101=上门自提',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '订单备注',
  `expired_at` timestamp(0) NULL DEFAULT NULL COMMENT '过期时间',
  `paid_at` timestamp(0) NULL DEFAULT NULL COMMENT '支付时间',
  `shipping_at` timestamp(0) NULL DEFAULT NULL COMMENT '发货时间',
  `deal_done_at` timestamp(0) NULL DEFAULT NULL COMMENT '交易完成时间',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '商城订单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_shop_orders
-- ----------------------------
INSERT INTO `yh_shop_orders` VALUES (1, NULL, NULL, NULL, '123123', '20190530084338', 500000.00, NULL, 0.00, 101, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 11:53:56', '2019-05-30 12:03:03');
INSERT INTO `yh_shop_orders` VALUES (2, NULL, NULL, NULL, '13888888883', '20190530179826', 12300.00, NULL, 0.00, 101, 101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 12:04:24', '2019-05-30 12:05:54');

-- ----------------------------
-- Table structure for yh_subjec
-- ----------------------------
DROP TABLE IF EXISTS `yh_subjec`;
CREATE TABLE `yh_subjec`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '科目名字',
  `period_num` int(10) NULL DEFAULT NULL COMMENT '课时总数',
  `student_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '学生价格',
  `employee_price` decimal(10, 2) NULL DEFAULT NULL COMMENT '员工价格',
  `audition_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '试听链接地址',
  `state` smallint(3) NULL DEFAULT NULL COMMENT '100正常  101禁用 102删除',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '科目表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yh_system_config
-- ----------------------------
DROP TABLE IF EXISTS `yh_system_config`;
CREATE TABLE `yh_system_config`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `system_config_code_unique`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_system_config
-- ----------------------------
INSERT INTO `yh_system_config` VALUES (1, 'participation_fee', '{\"province\":[{\"range\":\"0,30\",\"fee\":\"30\",\"credit_score\":\"30\"},{\"range\":\"31,50\",\"fee\":\"50\",\"credit_score\":\"50\"},{\"range\":\"51,100\",\"fee\":\"100\",\"credit_score\":\"100\"},{\"range\":\"100,\",\"fee\":\"200\",\"credit_score\":\"200\"}],\"city\":[{\"range\":\"0,30\",\"fee\":\"30\",\"credit_score\":\"30\"},{\"range\":\"31,50\",\"fee\":\"50\",\"credit_score\":\"50\"}],\"district\":[{\"range\":\"0,30\",\"fee\":\"30\",\"credit_score\":\"30\"},{\"range\":\"31,50\",\"fee\":\"50\",\"credit_score\":\"50\"}]}');
INSERT INTO `yh_system_config` VALUES (4, 'top_time', '12');
INSERT INTO `yh_system_config` VALUES (5, 'top_color', '#000000');

-- ----------------------------
-- Table structure for yh_user_exam
-- ----------------------------
DROP TABLE IF EXISTS `yh_user_exam`;
CREATE TABLE `yh_user_exam`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `exam_id` int(10) NULL DEFAULT NULL COMMENT '考试id',
  `course_id` int(10) NULL DEFAULT NULL COMMENT '课程id',
  `user_id` int(10) NULL DEFAULT NULL,
  `total_points` int(10) NULL DEFAULT NULL COMMENT '总分',
  `pass_mark` int(10) NULL DEFAULT NULL COMMENT '及格分',
  `grades` int(255) NULL DEFAULT NULL COMMENT '成绩',
  `type` smallint(3) NULL DEFAULT NULL COMMENT '100及格 101未及格',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '现场用户考试表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_user_exam
-- ----------------------------
INSERT INTO `yh_user_exam` VALUES (0000000001, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_user_exam` VALUES (0000000002, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_user_exam` VALUES (0000000003, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_user_exam` VALUES (0000000018, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_user_message
-- ----------------------------
DROP TABLE IF EXISTS `yh_user_message`;
CREATE TABLE `yh_user_message`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL COMMENT '电话',
  `message_id` int(10) NULL DEFAULT NULL COMMENT '消息id',
  `type` int(255) NULL DEFAULT NULL COMMENT '消息类型',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户消息表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_user_message
-- ----------------------------
INSERT INTO `yh_user_message` VALUES (0000000001, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_user_message` VALUES (0000000002, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_user_message` VALUES (0000000003, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_user_message` VALUES (0000000018, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_user_onlin_exam
-- ----------------------------
DROP TABLE IF EXISTS `yh_user_onlin_exam`;
CREATE TABLE `yh_user_onlin_exam`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `online_exam_id` int(10) NULL DEFAULT NULL COMMENT '线上考试',
  `spend` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '回答所有题目的用时',
  `finish_time` timestamp(0) NULL DEFAULT NULL COMMENT '提交时间。为空表示本次练习没有完成，也即没有交卷。每个人没有完成的练习，始终只有一个。只有交卷之后，才能创建新的练习',
  `score` int(10) NULL DEFAULT NULL COMMENT '本次考试得分',
  `tpye` smallint(3) NULL DEFAULT NULL COMMENT '100及格 101不级格',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户线上考试表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_user_onlin_exam
-- ----------------------------
INSERT INTO `yh_user_onlin_exam` VALUES (0000000001, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_user_onlin_exam` VALUES (0000000002, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_user_onlin_exam` VALUES (0000000003, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_user_onlin_exam` VALUES (0000000018, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_user_onlin_exam_exercises
-- ----------------------------
DROP TABLE IF EXISTS `yh_user_onlin_exam_exercises`;
CREATE TABLE `yh_user_onlin_exam_exercises`  (
  `id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `user_onlin_exam_id` int(10) NULL DEFAULT NULL COMMENT '用户线上考试id',
  `execrcises_id` int(10) NULL DEFAULT NULL COMMENT '习题id',
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '题目的正确答案',
  `answer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '每道题静默提交时更新：用户提交的答案',
  `is_correct` smallint(3) NULL DEFAULT NULL COMMENT '每道题静默提交时更新：答案是否正确  100正确 101不正确',
  `spend` int(10) NULL DEFAULT NULL COMMENT '每道题静默提交时更新：本题用时秒数',
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = '用户线上考试-习题表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_user_onlin_exam_exercises
-- ----------------------------
INSERT INTO `yh_user_onlin_exam_exercises` VALUES (0000000001, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-20 10:17:02', NULL);
INSERT INTO `yh_user_onlin_exam_exercises` VALUES (0000000002, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-21 10:57:47', NULL);
INSERT INTO `yh_user_onlin_exam_exercises` VALUES (0000000003, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-24 14:53:52', NULL);
INSERT INTO `yh_user_onlin_exam_exercises` VALUES (0000000018, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-30 11:34:14', NULL);

-- ----------------------------
-- Table structure for yh_users
-- ----------------------------
DROP TABLE IF EXISTS `yh_users`;
CREATE TABLE `yh_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '用户类型：100=普通用户,101=合伙人用户',
  `partner_level_id` tinyint(3) UNSIGNED NULL DEFAULT NULL COMMENT '合伙人等级ID',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户头像',
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `real_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `id_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份证号',
  `openid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信openid',
  `unionid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信unionid',
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '设备唯一ID',
  `invitation_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邀请码',
  `inviter_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '邀请人ID',
  `notification_count` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '未读消息数',
  `credit_score` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '信用积分',
  `gold_score` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '金积分',
  `silver_score` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '银积分',
  `coupons_total` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '代金券总额',
  `last_actived_at` timestamp(0) NULL DEFAULT NULL COMMENT '最后登录时间',
  `last_actived_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `is_auth` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '认证状态：100=未认证,101=已认证',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_users
-- ----------------------------
INSERT INTO `yh_users` VALUES (1, 100, NULL, 'admin', '$2y$10$LStpWAJZ/Ho/hltiX5HhB.e5pBp5b9Ep91MIemTdWhd6VbdPPoSzO', '', '', 'admin', '', '', '', '', '', '', NULL, 0, 0, 0, 0, 0.00, '2019-06-30 17:47:35', '127.0.0.1', 100, NULL, NULL, '2019-05-20 10:17:02', '2019-06-30 17:47:35');
INSERT INTO `yh_users` VALUES (2, 100, NULL, '13594369472', '$2y$10$ng9lEKoyZaDkvfKjbRV3DON5SJJRR7DX/DeDiJpEKTX4PMOv6MRTm', '', 'avatar/5yqLQug2pW12qkmjtEJvjDI0jmF7Nm9aqfcqfyM1.jpeg', '13594369472', '', '', '', '', '', '', NULL, 0, 0, 0, 0, 0.00, '2019-06-02 16:40:08', '183.228.25.128', 100, NULL, NULL, '2019-05-21 10:57:47', '2019-06-02 16:40:08');
INSERT INTO `yh_users` VALUES (3, 100, NULL, '15730241991', '$2y$10$vbY0Ve3KWTQDSJJ4Ejaw/.f//rAJZ7jzT8Zfc13egXcuGgtmnJBMC', '', '', '15730241991', '', '', '', '', '', '', NULL, 0, 0, 0, 0, 0.00, '2019-06-11 11:41:38', '125.85.203.172', 100, NULL, NULL, '2019-05-24 14:53:52', '2019-06-12 17:14:44');
INSERT INTO `yh_users` VALUES (18, 100, NULL, '18184766606', '$2y$10$QnAIeSEp9CBF5dqdnH/sc.4KNxvXTXW2IRVXyjsiQaVmhfhqw8M92', '', '', '18184766606', '', '', '', '', '', '', NULL, 0, 0, 0, 0, 0.00, '2019-05-30 11:34:28', '125.85.204.114', 100, NULL, NULL, '2019-05-30 11:34:14', '2019-05-30 11:34:28');
INSERT INTO `yh_users` VALUES (19, 100, NULL, '15178809691', '$10$LStpWAJZ/Ho/hltiX5HhB.e5pBp5b9Ep91MIemTdWhd6VbdPPoSzO', '', '', '15178809691', '', '', '', '', '', '', NULL, 0, 0, 0, 0, 0.00, NULL, '', 100, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for yh_users_bbb
-- ----------------------------
DROP TABLE IF EXISTS `yh_users_bbb`;
CREATE TABLE `yh_users_bbb`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '用户类型：100=普通用户,101=学生',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `real_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `birthday` timestamp(0) NULL DEFAULT NULL COMMENT '生日',
  `gender` smallint(3) NULL DEFAULT NULL COMMENT '性别 100男  101女',
  `ethnic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名族',
  `politics_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '政治面貌',
  `school` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '学校',
  `student_number` int(10) NULL DEFAULT NULL COMMENT '学号',
  `graduation_date` timestamp(0) NULL DEFAULT NULL COMMENT '毕业时间',
  `qq` int(10) NULL DEFAULT NULL,
  `weixin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `examination_venues_id` int(10) NULL DEFAULT NULL COMMENT '考试地点id',
  `provinces_id` int(10) NULL DEFAULT NULL COMMENT '省id',
  `city_id` int(10) NULL DEFAULT NULL COMMENT '市id',
  `district_id` int(10) NULL DEFAULT NULL COMMENT '区id',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '详情地址',
  `class_major` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '在校班级及专业',
  `work_unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '工作单位',
  `identity_just` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证正面',
  `identity_versa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '身份证反面',
  `identification_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '证件照',
  `student_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '学生证照片',
  `id_card` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '身份证号',
  `openid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信openid',
  `unionid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '微信unionid',
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '设备唯一ID',
  `invitation_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '邀请码',
  `inviter_id` int(10) UNSIGNED NULL DEFAULT NULL COMMENT '经销商ID',
  `notification_count` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '未读消息数',
  `last_actived_at` timestamp(0) NULL DEFAULT NULL COMMENT '最后登录时间',
  `last_actived_ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '最后登录ip',
  `is_auth` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '认证状态：100=未认证,101=已认证',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yh_users_bbb
-- ----------------------------
INSERT INTO `yh_users_bbb` VALUES (1, 100, '$10$LStpWAJZ/Ho/hltiX5HhB.e5pBp5b9Ep91MIemTdWhd6VbdPPoSzO', '', '13888888883', '13888888883', NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', NULL, 0, NULL, '', 100, NULL, NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
